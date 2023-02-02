const blocksAndTheirListeners = {
    'calc-get-type': () => {
        $('#otherTypeDesc').parent('label').hide();
        $('#calc-site-type').change((e) => {
            const optionValue = e.target.selectedOptions[0].value;
            if (optionValue === "other")
                $('#otherTypeDesc').parent('label').show();
            else
                $('#otherTypeDesc').parent('label').hide();
            if (optionValue === "Landing") {
                $('#sitePageAmount').val(1);
                $('#sitePageAmount').prop('disabled', true);
            } else {
                $('#sitePageAmount').prop('disabled', false);
            }
        });
        $('#calc-next-btn').click((e) => {
            if (!checkFilled(['#calc-site-type', '#sitePageAmount'])) return;
            addToResults('site-type', $('#calc-site-type').val());
            addToResults('site-type-desc', $('#otherTypeDesc').val());
            addToResults('site-total-pages', $('#sitePageAmount').val())
            renderBlock('calc-has-design');
        })
    },
    'calc-has-design': () => {
        $('#calc-next-btn').hide();
        $('#calc-has-design .btn').show();
        $('#calc-has-design .btn').click((e) => {
            const res = Boolean($(e.target).data('btn-result'));
            addToResults('site-has-design', res);
            if (res)
                renderBlock('calc-get-pages');
            else
                renderBlock('calc-need-adaptive');

        })
    },
    'calc-get-pages': () => {
        const pagesAmount = getFromResults('site-total-pages');
        if (pagesAmount == 1)
            $('.calc-block-pages-grid').addClass('solo-page');
        const blockPageTemplate = $('.calc-block-page');
        $('.calc-block-page').remove();
        for (let i = 1; i <= pagesAmount; i++) {
            const clone = $(blockPageTemplate).clone().data('page-num', i);
            $(clone).children('.typeset-big').text(`Страница ${i}`);
            $('.calc-block-pages-grid').append(clone);
        }
        $('label[name="simpleHasAnim"]').click((e) => {
            let target = e.target;
            if (!$(target).is('label[name="simpleHasAnim"]'))
                target = $(e.target).parent('label[name="simpleHasAnim"]');
            $(target).siblings('label[name="simpleSectionsAnimAmount"]').children('input[type="number"]').prop("disabled", !$(e.target).is(':checked'));
        });
        $('label[name="hardHasAnim"]').click((e) => {
            let target = e.target;
            if (!$(target).is('label[name="hardHasAnim"]'))
                target = $(e.target).parent('label[name="hardHasAnim"]');
            $(target).siblings('label[name="hardSectionsAnimAmount"]').children('input[type="number"]').prop("disabled", !$(e.target).is(':checked'));
        });
        $('#calc-next-btn').click((e) => {
            if (!checkFilled(['label[name="simpleSectionsAmount"] input', 'label[name="hardSectionsAmount"] input'])) return;
            const results = {};
            $('.calc-block-page').each((i, elem) => {
                const elemResult = {
                    'simpleSectionsAmount': $(elem).find('label[name="simpleSectionsAmount"] input[type="number"]').val(),
                    'hardSectionsAmount': $(elem).find('label[name="hardSectionsAmount"] input[type="number"]').val(),
                    'simpleHasAnim': $(elem).find('label[name="simpleHasAnim"] input[type="checkbox"]').is(':checked'),
                    'simpleSectionsAnimAmount': $(elem).find('label[name="simpleSectionsAnimAmount"] input[type="number"]').val(),
                    'hardHasAnim': $(elem).find('label[name="hardHasAnim"] input[type="checkbox"]').is(':checked'),
                    'hardSectionsAnimAmount': $(elem).find('label[name="hardSectionsAnimAmount"] input[type="number"]').val()
                }
                results[`page-${i + 1}`] = elemResult;
            });
            addToResults('site-pages', results);
            console.log(results);
            renderBlock('calc-design-has-adaptive');
        })
    },
    'calc-design-has-adaptive': () => {
        $('#calc-next-btn').hide();
        $('#calc-design-has-adaptive .btn').show();
        $('#calc-design-has-adaptive .btn').click((e) => {
            const res = Boolean($(e.target).data('btn-result'));
            addToResults('site-design-has-adaptive', res);
            renderBlock('calc-get-offcanvas');
        })
    },
    'calc-need-adaptive': () => {
        $('#calc-next-btn').hide();
        $('#calc-need-adaptive .btn').show();
        $('#calc-need-adaptive .btn').click((e) => {
            const res = Boolean($(e.target).data('btn-result'));
            addToResults('site-need-adaptive', res);
            renderBlock('calc-get-offcanvas');
        })
    },
    'calc-get-offcanvas': () => {
        $('#calc-next-btn').hide();
        $('#calc-get-offcanvas .btn').show();
        $('#calc-get-offcanvas .btn').click((e) => {
            const res = Boolean($(e.target).data('btn-result'));
            addToResults('site-need-offcanvas', res);
            renderBlock('calc-get-has-backend');
        })
    },
    'calc-get-has-backend': () => {
        const siteType = getFromResults('site-type');
        if (['personalBlog', 'portal', 'socnet', 'shop'].indexOf(siteType) > -1) {
            addToResults('site-need-backend', true);
            renderBlock('calc-get-backend-type', true);
            return;
        }
        $('#calc-next-btn').hide();
        $('#calc-get-has-backend .btn').show();
        $('#calc-get-has-backend .btn').click((e) => {
            const res = Boolean($(e.target).data('btn-result'));
            addToResults('site-need-backend', res);
            if (res)
                renderBlock('calc-get-backend-type', true);
            else
                setFinal();
        })
    },
    'calc-get-backend-type': () => {
        return;
    }
}

$(() => {
    $('.calc-block').hide();
    $('.calc-btn').hide();
    renderStart();
})

const renderStart = () => {
    $('#calc-start').show();
    $('#calc-start-btn').show();
    $('#calc-start-btn').click(() => {
        $('#calc-start').hide();
        renderBlock('calc-get-type')
    })
}

const renderBlock = (blockId, isFinal = false) => {
    $('.calc-btn').hide();
    $('#calc-next-btn').off();
    $('.calc-block').hide();
    $(`#${blockId}`).show();
    if (isFinal)
        $('#calc-finish-btn').show();
    else
        $('#calc-next-btn').show();
    blocksAndTheirListeners[blockId]();
    if (isFinal) {
        $('#calc-finish-btn').click(setFinal);
    }
}

const checkFilled = (elemSelectorsCol) => {
    let res = true;
    elemSelectorsCol.forEach((elemSelector) => {
        $(elemSelector).each((i, elem) => {
            if ($(elem).val() === 'none' || $(elem).val() === '') {
                showUnFilled(elem);
                res = false;
            }
        })
    })
    return res;
}

const addToResults = (fieldName, fieldValue) => {
    let resultsJSON = JSON.parse($('#results-input').val());
    resultsJSON[fieldName] = fieldValue;
    $('#results-input').val(JSON.stringify(resultsJSON));
}

const getFromResults = (fieldName) => {
    const resultsJSON = JSON.parse($('#results-input').val());
    return resultsJSON[fieldName];
}

const setFinal = () => {
    if ($('#calc-backend-type').is(':visible') && !checkFilled(['#calc-backend-type'])) return;
    addToResults('site-backend-type', $('#calc-backend-type').val());
    const resultsJSON = JSON.parse($('#results-input').val());

    const resultPrice = (totalPages, totalSimpleScreens, totalHardScreens, totalAnimations, kBackend, hasDesign, hasResponsiveDesign, hasOffcanvas) => {
        /* смысл формулы:
            !hasDesign * (totalPages * 2000 * (4 - hasResponsiveDesign))
            если дизайна нет, его надо сначала сделать
            если вдруг клиенту не надо адаптивный дизайн, а только под комп, то скидка на этот пункт 2000 рублей, иначе по 8000 за страницу + адаптив
            3000 + 1000 * (totalPages - 1)
            далее 3000 базово за 1 свёрстанную страницу. 1 свёрстанная страница это хэдер, футер и 1 секция
            но поскольку хэдер и футер как правило повторяются, то 3000 только за 1 страницу, а дальше по 1000
            hasDesign * ((totalSimpleScreens + 2 * totalHardScreens - 3 - (totalPages - 1) - !hasResponsiveDesign * 0.3 * (totalSimpleScreens + totalHardScreens)) * 1000 + totalAnimations * 500)
            следующее - если есть дизайн уже, тогда только вёрстка. каждый дополнительный экран 1000 рублей. сложные по двойному тарифу.
            каждая анимация ещё 500 рублей. за отсутствие адаптива небольшое понижение ценника
            если же дизайна нет, то 
            !hasDesign * 1500 * totalPages * (4 - hasResponsiveDesign)
            ориентировочно по 6000 рублей за страницу поверху тех 3 тысяч базовых, по 4500 если без адаптивного дизайна 
            оффканвасы ориентрировочно 2 тысячи, ибо там немного посложнее, там ведь и JS надо настроить, и слушателей навешать и всё такое
            последнее - это бэкенд, тут всё просто, по 5000 за посадку одной страницы базово, а дальше в зависимости от выбранного бэка всё или сложнее,
            или может легче даже, или так же. kBackend - коэффициент сложности посадки
        */
        return !hasDesign * (totalPages * 2000 * (4 - hasResponsiveDesign)) + 3000 + 1000 * (totalPages - 1) + hasDesign * ((totalSimpleScreens + 2 * totalHardScreens - 3 - (totalPages - 1) - !hasResponsiveDesign * 0.3 * (totalSimpleScreens + totalHardScreens)) * 1000 + totalAnimations * 500) + !hasDesign * 1500 * totalPages * (4 - hasResponsiveDesign) + 2000 * hasOffcanvas + 5000 * totalPages * kBackend;
    }
    

}
