<?php

namespace Tests\Feature;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GalleryUploadTest extends TestCase
{
    use RefreshDatabase;

    private function realUpload(string $name, string $content): UploadedFile
    {
        static $handles = [];
        $handle = tmpfile();
        fwrite($handle, $content);
        $handles[] = $handle;

        return new UploadedFile(stream_get_meta_data($handle)['uri'], $name, null, null, true);
    }

    public function test_invalid_uploads_are_rejected_on_create_and_update_without_replacing_the_existing_file(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create());
        $gallery = new Gallery();
        $gallery->title = 'Original';
        $gallery->media_type = 'image';
        $gallery->sort_order = 1;
        $gallery->status = true;
        $gallery->file_path = 'gallery/original.jpg';
        $gallery->save();
        Storage::disk('public')->put($gallery->file_path, 'original');

        foreach (['store', 'update'] as $action) {
            foreach (['php', 'disguised', 'extension', 'svg', 'gif', 'oversized'] as $case) {
                $file = match ($case) {
                    'php' => $this->realUpload('payload.php', '<?php echo 1;'),
                    'disguised' => $this->realUpload('photo.jpg', '<?php echo 1;'),
                    'extension' => $this->realUpload('photo.txt', UploadedFile::fake()->image('photo.jpg')->getContent()),
                    'svg' => $this->realUpload('photo.svg', '<svg xmlns="http://www.w3.org/2000/svg"></svg>'),
                    'gif' => UploadedFile::fake()->image('photo.gif'),
                    'oversized' => UploadedFile::fake()->image('photo.jpg')->size(20481),
                };
                $data = ['title' => 'Changed', 'media_type' => 'image', 'sort_order' => 1, 'status' => 1, 'file' => $file];
                $response = $action === 'store'
                    ? $this->post(route('admin.gallery.store'), $data)
                    : $this->put(route('admin.gallery.update', $gallery), $data);
                $response->assertSessionHasErrors('file');
                $this->assertSame(1, Gallery::count());
                $this->assertSame('Original', $gallery->fresh()->title);
                Storage::disk('public')->assertExists('gallery/original.jpg');
                $this->assertCount(1, Storage::disk('public')->allFiles());
            }
        }
    }

    public function test_allowed_images_can_be_created_and_replaced_and_file_is_optional_on_edit(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create());
        foreach (['jpg', 'jpeg', 'png', 'webp'] as $extension) {
            $data = ['title' => 'Photo', 'media_type' => 'image', 'sort_order' => 1, 'status' => 1];
            $this->post(route('admin.gallery.store'), $data + ['file' => UploadedFile::fake()->image('photo.'.$extension)])
                ->assertSessionHasNoErrors()->assertRedirect(route('admin.gallery.index'));
            $gallery = Gallery::latest('id')->firstOrFail();
            $oldPath = $gallery->file_path;
            Storage::disk('public')->assertExists($oldPath);
            $this->put(route('admin.gallery.update', $gallery), $data + ['file' => UploadedFile::fake()->image('replacement.'.$extension)])
                ->assertSessionHasNoErrors();
            Storage::disk('public')->assertMissing($oldPath);
            $newPath = $gallery->fresh()->file_path;
            Storage::disk('public')->assertExists($newPath);
            $this->put(route('admin.gallery.update', $gallery), $data)->assertSessionHasNoErrors();
            $this->assertSame($newPath, $gallery->fresh()->file_path);
        }
    }
}