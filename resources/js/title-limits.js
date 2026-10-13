// Keep existing overlong values visible so editors can shorten them deliberately.
export function updateTitleCounter(input, counter) {
    const length = Array.from(input.value).length;
    const overLimit = length > 80;
    counter.textContent = length + '/80 caracteres' + (overLimit ? ' — Reduce el texto para guardar.' : '');
    counter.classList.toggle('title-counter-error', overLimit);
    input.setCustomValidity(overLimit ? 'El título o subtítulo no puede superar los 80 caracteres.' : '');
}

function initializeTitleLimits() {
    document.querySelectorAll('[data-title-limit]').forEach((input, index) => {
        const counter = input.parentElement.querySelector('[data-title-counter]');
        if (!counter || input.dataset.counterReady) return;
        input.dataset.counterReady = 'true';
        counter.id = 'title-counter-' + index;
        input.setAttribute('aria-describedby', [input.getAttribute('aria-describedby'), counter.id].filter(Boolean).join(' '));
        const update = () => updateTitleCounter(input, counter);
        input.addEventListener('input', update);
        input.addEventListener('change', update);
        input.form?.addEventListener('reset', () => setTimeout(update, 0));
        update();
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeTitleLimits);
} else {
    initializeTitleLimits();
}
