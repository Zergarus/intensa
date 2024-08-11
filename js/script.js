const loginForm = document.querySelector('#register, #login');
if(loginForm !== null){
    loginForm.addEventListener('submit', (event) => {
        event.preventDefault(); // Предотвращаем стандартную отправку формы
        const formData = new FormData(loginForm); // Создаем объект FormData из данных формы
        // Отправляем данные с помощью fetch
        fetch('/'+event.currentTarget.id+'/', {
            headers: {
                Accept: "application/json"
            },
            method: 'POST',
            body: formData,
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Ошибка сервера: ${response.status}`);
                }
                return response.json(); // Парсим ответ в JSON
            })
            .then(data => {
                if (data.success == false) {
                    alert(data.message);
                } else {
                    window.location.href='/';
                }
            })
            .catch(error => {
                // Обработка ошибки
                console.error('Ошибка отправки формы:', error);
            });
    });
}
const reviewForm = document.querySelector('#review');

if(reviewForm !== null){
    reviewForm.addEventListener('submit', (event) => {
        event.preventDefault(); // Предотвращаем стандартную отправку формы
        const formData = new FormData(reviewForm); // Создаем объект FormData из данных формы
        // Отправляем данные с помощью fetch
        fetch('/product/', {
            headers: {
                Accept: "application/json"
            },
            method: 'POST',
            body: formData,
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Ошибка сервера: ${response.status}`);
                }
                return response.json(); // Парсим ответ в JSON
            })
            .then(data => {
                if (data.success == false) {
                    alert(data.message);
                } else {
                    window.location.href='/';
                }
            })
            .catch(error => {
                // Обработка ошибки
                console.error('Ошибка отправки формы:', error);
            });
    });
}