<?php
namespace App\Rules;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;
class UsableSlug implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (is_string($value) && Str::slug($value) === '') {
            $fail('El título o nombre debe incluir letras o números que permitan generar una URL válida. No puede contener únicamente símbolos.');
        }
    }
}
