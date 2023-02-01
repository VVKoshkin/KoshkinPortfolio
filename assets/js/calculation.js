const blocksAndTheirListeners = {
    'calc-get-type':() => {
        $('#otherTypeDesc').parent('label').hide();
        $('#calc-site-type').change((e) => {
            const optionValue = e.target.selectedOptions[0].value;
            if (optionValue === "other")
                $('#otherTypeDesc').parent('label').show();
            else
                $('#otherTypeDesc').parent('label').hide();
            if (optionValue === "Landing") {
                $('#sitePageAmount').val(1);
                $("input").prop('disabled', true);
            } else {
                $("input").prop('disabled', false);
            }
        });
        $('#calc-next-btn').click((e) => {
            renderBlock('calc-has-design', true);
        })
    },
    'calc-has-design':() => {
        // TODO
    }
}

$(()=> {
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
    $('.calc-block').hide();
    $(`#${blockId}`).show();
    if (isFinal)
        $('#calc-finish-btn').show();
    else
        $('#calc-next-btn').show();
    blocksAndTheirListeners[blockId]();    
}