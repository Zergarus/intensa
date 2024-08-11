const loginForm = document.querySelector('#register, #login');
if (loginForm !== null) {
    loginForm.addEventListener('submit', (event) => {
        event.preventDefault(); // Предотвращаем стандартную отправку формы
        const formData = new FormData(loginForm); // Создаем объект FormData из данных формы
        // Отправляем данные с помощью fetch
        fetch('/' + event.currentTarget.id + '/', {
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
                    window.location.href = '/';
                }
            })
            .catch(error => {
                // Обработка ошибки
                console.error('Ошибка отправки формы:', error);
            });
    });
}
const reviewForm = document.querySelector('#review');

if (reviewForm !== null) {
    reviewForm.addEventListener('submit', (event) => {
        event.preventDefault(); // Предотвращаем стандартную отправку формы
        const formData = new FormData(reviewForm); // Создаем объект FormData из данных формы
        formData.append("action", "add");
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
                    window.location.reload();
                }
            })
            .catch(error => {
                // Обработка ошибки
                console.error('Ошибка отправки формы:', error);
            });
    });
}

const updateButtons = document.querySelectorAll('.update');
if (updateButtons !== null) {
    updateButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const itemId = button.dataset.id;
            const details = document.querySelector('.reviews-form[data-item-id="' + itemId + '"]');
            details.style.display = 'block';
        });
    });
}
const updateForms = document.querySelectorAll('.reviews_detail form');
if (updateForms !== null) {
    updateForms.forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const updateFormData = new FormData(form); // Создаем объект FormData из данных формы
            updateFormData.append("action", "update");
            // Отправляем данные с помощью fetch
            fetch('/product/', {
                headers: {
                    Accept: "application/json"
                },
                method: 'POST',
                body: updateFormData,
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
                        window.location.reload();
                    }
                })
                .catch(error => {
                    // Обработка ошибки
                    console.error('Ошибка отправки формы:', error);
                });
        });
    });
}

const deleteButtons = document.querySelectorAll('.delete');
if (deleteButtons !== null) {
    deleteButtons.forEach(delButton => {
        delButton.addEventListener('click', (e) => {
            e.preventDefault();
            const revId = delButton.dataset.id;
            const itemId = delButton.dataset.itemId;
            const deleteData = new FormData();
            deleteData.append("id", revId);
            deleteData.append("item_id", itemId);
            deleteData.append("action", "remove");

            fetch('/product/', {
                headers: {
                    Accept: "application/json"
                },
                method: 'POST',
                body: deleteData,
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
                        window.location.reload();
                    }
                })
                .catch(error => {
                    // Обработка ошибки
                    console.error('Ошибка отправки формы:', error);
                });
        });
    });
}

