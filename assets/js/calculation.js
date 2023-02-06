const kBackendDic = {
    'noidea': 1,
    'Spring': 8,
    'Flask': 6,
    'WordPress': 1,
    'OpenCart': 5,
    'Joomla': 5,
    'none': 0
};

const blocksAndTheirListeners = {
    'calc-get-type': () => {
        $('#otherTypeDesc').parent('label').hide();
        for (let val in siteTypes) {
            const optionHTML = `<option value="${val}">${siteTypes[val]}</option>`
            $('#calc-site-type').append($(optionHTML));
        }
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
        if (['personalBlog', 'portal', 'socnet', 'shop', 'forum'].indexOf(siteType) > -1) {
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
        for (let val in backendTypes) {
            const optionHTML = `<option value="${val}">${backendTypes[val]}</option>`
            $('#calc-backend-type').append($(optionHTML));
        }
    }
}

const siteTypes = {
    'Landing': 'Лэндинг',
    'personalBlog': 'Личный блог',
    'visit': 'Сайт-визитка',
    'portal': 'Корпортативный или новостной портал',
    'socnet': 'Социальная сеть',
    'shop': 'Интернет-магазин',
    'forum': 'Форум',
    'other': 'Что-то другое',
}

const backendTypes = {
    'WordPress': 'CMS WordPress',
    'OpenCart': 'CMS OpenCart',
    'Joomla': 'CMS Joomla',
    'Flask': 'Собственный движок на Python Flask',
    'Spring': 'Собственный движок на Java Spring Boot',
    'noidea': 'Нужна консультация/Мне без разницы',
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
    $(window).scrollTop(0);
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

    $('.calc-block').hide();
    $('.calc-btn').hide();
    $('#calc-finish').show();
    $(window).scrollTop(0);

    const resultPrice = (totalPages, totalSimpleScreens, totalHardScreens, totalAnimations, kBackend, hasDesign, hasResponsiveDesign, hasOffcanvas) => {
        const designPrice = !hasDesign * (totalPages * 2000 * (4 - hasResponsiveDesign));
        const layoutPriceIfHasPagesInfo = hasDesign * (2000 + 500 * (totalPages - 1) + ((totalSimpleScreens + 2 * totalHardScreens - 3 - (totalPages - 1) - !hasResponsiveDesign * 0.3 * (totalSimpleScreens + totalHardScreens)) * 1000 + totalAnimations * 500))
        const layoutPriceIfNoPagesInfo = !hasDesign * 1500 * totalPages * (4 - hasResponsiveDesign);
        const offcanvas = 1000 * hasOffcanvas;
        const backend = 5000 * totalPages * kBackend;
        return {
            'Дизайн-макет': designPrice,
            'Вёрстка': layoutPriceIfHasPagesInfo,
            'Вёрстка (ориентировочно для такого количества страниц)': layoutPriceIfNoPagesInfo,
            'Модальные окна': offcanvas,
            'Бэкенд': backend
        };
    }
    const totalPages = getFromResults('site-total-pages');
    const totalSimpleScreens = () => {
        let res = 0;
        if (!getFromResults('site-has-design'))
            return res;
        for (let i = 1; i <= totalPages; i++) {
            res += parseInt(getFromResults('site-pages')[`page-${i}`]['simpleSectionsAmount']);
        }
        return res;
    }
    const totalHardScreens = () => {
        let res = 0;
        if (!getFromResults('site-has-design'))
            return res;
        for (let i = 1; i <= totalPages; i++) {
            res += parseInt(getFromResults('site-pages')[`page-${i}`]['hardSectionsAmount']);
        }
        return res;
    }
    const totalAnimations = () => {
        let res = 0;
        if (!getFromResults('site-has-design'))
            return res;
        for (let i = 1; i <= totalPages; i++) {
            const simpleHasAnim = getFromResults('site-pages')[`page-${i}`]['simpleHasAnim'];
            const simpleSectionsAnimAmount = getFromResults('site-pages')[`page-${i}`]['simpleSectionsAnimAmount'];
            res += parseInt(simpleHasAnim ? (simpleSectionsAnimAmount !== '' ? simpleSectionsAnimAmount : 0) : 0);

            const hardHasAnim = getFromResults('site-pages')[`page-${i}`]['hardHasAnim'];
            const hardSectionsAnimAmount = getFromResults('site-pages')[`page-${i}`]['hardSectionsAnimAmount'];
            res += parseInt(hardHasAnim ? (hardSectionsAnimAmount !== '' ? hardSectionsAnimAmount : 0) : 0);
        }
        return res;
    }
    const kBackend = () => {
        if (!getFromResults('site-need-backend')) return 0;
        return kBackendDic[getFromResults('site-backend-type')]
    }
    // hasDesign, hasResponsiveDesign, hasOffcanvas
    const hasDesign = getFromResults('site-has-design');
    // hard to explain, but: undefined || <some boolean value> = <some boolean value>
    const hasResponsiveDesign = getFromResults('site-design-has-adaptive') || getFromResults('site-need-adaptive');
    const hasOffcanvas = getFromResults('site-need-offcanvas');
    const result = resultPrice(totalPages, totalSimpleScreens(), totalHardScreens(), totalAnimations(), kBackend(), hasDesign, hasResponsiveDesign, hasOffcanvas);
    drawEstimateTable(result);
    $('button[data-action="openOrderForm"]').show();
    // автозаполнение текста заказа
    $('button[data-action="openOrderForm"]').click(() => {
    });
}

const drawEstimateTable = (rows) => {
    let sum = 0;
    for (let curRowState in rows) {
        const curRowPrice = rows[curRowState];
        if (curRowPrice === 0) continue;
        const rowLayoutHTML = `
                <tr>
                    <td>${curRowState}</td>
                    <td>${curRowPrice}</td>
                </tr>`;
        sum += curRowPrice;
        $('#estimate-table tbody').append($(rowLayoutHTML));
    }
    const rowLayoutHTML = `
                <tr>
                    <td>Итого</td>
                    <td>${sum}</td>
                </tr>`;
    $('#estimate-table tbody').append($(rowLayoutHTML));
}
