const formOrderOptionValueToInput = {
    'TG': '<input placeholder="Имя пользователя Telegram" type="text" name="connection-type-value" required>',
    'VK': '<input placeholder="Ссылка на страницу VK" type="text" name="connection-type-value" required>',
    'e-mail': '<input placeholder="Ваш e-mail" type="email" name="connection-type-value" required>',
    'phone': '<input placeholder="Ваш телефон" type="text" name="connection-type-value" required>'
}

$(() => {
    // установка темы, если пользователь выбирал ранее
    let pageTheme = localStorage.getItem('page-theme');
    if (pageTheme == null) pageTheme = 'theme-light';
    setTheme(pageTheme);
    refreshListeners();
});

const refreshListeners = () => {
    // хамбургер меню - для адаптива
    $('.navbar-hamburger').click(() => {
        $('.navbar-elements').toggle();
    });
    // переключатель тёмная/светлая тема
    $('#color-mode-switcher').click((e) => {
        e.preventDefault();
        $('html').toggleClass('theme-light theme-dark');
        localStorage.setItem('page-theme', $('html').attr('class'));
    });
    // открыть форму перезвоните мне
    $('button[data-action="openOrderForm"]').click(() => {
        openModal('form-order').done(setOrderFormListeners);
    });
    $('.my-portfolio-card').mouseenter((e)=> {
        let elem = e.target;
        if (!$(elem).hasClass('my-portfolio-card')) {
            elem =   $(elem).parents('.my-portfolio-card')          
        }
        loadPopup('portfolio-popup', elem).done(() => {
            setPopupMouseLeave();
            $('button[data-action="openOrderForm"]').click(() => {
                openModal('form-order').done(setOrderFormListeners);
            });
        });
    })
    $('.list-and-photo li').mouseenter((e) => {
        $(e.target).parents('.list-and-photo').children('.list-and-photo__img').empty();
        const fileName = $(e.target).data("imgFile");
        const layoutRawHTML = `<img src="img/for-lists/${fileName}" alt="" />`
        $(e.target).parents('.list-and-photo').children('.list-and-photo__img').append($(layoutRawHTML).addClass('fade-in'));
    })
}

const setTheme = (themeClass) => {
    $('html').removeClass();
    $('html').addClass(themeClass);
}

const showUnFilled = (domElem) => {
    // если делать это подряд одно за другим, не работает, нужен хотя бы небольшой таймаут
    setTimeout(() => {
        $(domElem).addClass('shakeAnimClass');
    }, 5
    )
    $(domElem).removeClass('shakeAnimClass');
}

const setOrderFormListeners = () => {
    // при выборе типа "как связаться" отображается input
    $('#connectionType').change((e) => {
        // $('.order-form').remove('input');
        $('input[name="connection-type-value"]').remove();
        const optionValue = e.target.selectedOptions[0].value;
        const inputRawHTML = formOrderOptionValueToInput[optionValue];
        $(inputRawHTML).show().insertAfter('.connection-type-div');
    });
    // переопределение поведения кнопки отправки для формы заявок
    $('#orderFormSubmit').click((e) => {
        e.preventDefault();
        const formInfo = {};
        let isBad = false;
        // 1. ФИО
        const orderFormNameElem = $('#order-form-name');
        const orderFormNameVal = $(orderFormNameElem).val();
        if (orderFormNameVal.trim() == '') {
            showUnFilled(orderFormNameElem);
            isBad = true;
        } else {
            formInfo.name = orderFormNameVal;
        }
        // 2. Как связаться
        if ($('#connectionType option').filter(':selected').val() == 'none') {
            showUnFilled($('#connectionType'));
            isBad = true;
        } else {
            formInfo.connectionType = $('#connectionType option').filter(':selected').val();
            // если заполнено
            // 3. значение инпута "как связаться"
            const connectionTypeValue = $('input[name="connection-type-value"]');
            if ($(connectionTypeValue).val().trim() == '') {
                showUnFilled(connectionTypeValue);
                isBad = true;
            } else {
                formInfo.connectionTypeValue = $(connectionTypeValue).val().trim();
            }
        }
        // 4. Описание необязательно, но если есть, тоже надо положить (иначе будет пустая строка)
        formInfo.description = $('#order-form-description').val();
        if (!isBad) {
            sendOrder(formInfo);
            openModal('form-confirmed').done(() => {
                $('.form-confirmed>button').click(() => {
                    destroyModal();
                });
            });
        }
    })
}

const setPopupMouseLeave = () => {
    $('.popup').mouseleave(() => {
        destroyPopup();
    })
}

const sendOrder = (formInfo) => {
    console.log(formInfo);
    // TODO: отправка e-mail, сообщения ВК, телеграм
}

const openModal = (fileName) => {
    return $.get(`../modals/${fileName}.html`, (data) => {
        $('body').append($(data).addClass('modal fade-in').append('<div class="modal-close"><img src="img/cross.png" alt="" /></div>'));
        $('.modal-close').click(() => {
            destroyModal();
        });
    });
}

const loadPopup = (fileName, parentElement) => {
    return $.get(`../popups/${fileName}.html`, (data) => {
        destroyPopup();
        $(parentElement).append($(data).addClass('popup fade-in'));
    });
}

const destroyModal = () => {
    $('.modal').remove();
}

const destroyPopup = () => {
    $('.popup').remove();
}