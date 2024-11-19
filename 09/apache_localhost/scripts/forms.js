document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('feedbackForm');
    
    
    if (window.location.search.includes('submitted=true')) {
        form.reset(); // Очищаем форму
    }

    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Останавливаем стандартное поведение отправки формы

        // Получаем данные формы
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                // Получаем текущие параметры URL
                const currentParams = new URLSearchParams(window.location.search);

                // Перенаправляем на тот же URL
                window.location.search = currentParams.toString();
                alert("Спасибо за отзыв!");
            } else {
                // Обработка ошибки, если отправка не прошла
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
