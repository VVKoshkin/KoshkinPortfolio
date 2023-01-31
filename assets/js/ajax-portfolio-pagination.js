$(() => {
    // клик на кружочке слайдера
    $('.my-portfolio-slider .slider-controller-circle').click((e) => {
        const pageToNavigate = $(e.target).data('pageNum');
        const curPage = $('.my-portfolio-slider').data('curPageNum');
        // если в кружочке та же страница, которая отображается сейчас, то ничего не делать
        if (pageToNavigate === curPage) return;
        makePage(pageToNavigate);
    });

    $('.my-portfolio-slider .slider-arrow').click((e) => {
        const curPage = $('.my-portfolio-slider').data('curPageNum');
        const totalPages = $('.my-portfolio-slider').data('totalPages');
        const navigationType = $(e.target).data('navigationType');
        let pageToNavigate = curPage;
        if (navigationType==='prev')
            pageToNavigate--;
        else if (navigationType === 'next')
            pageToNavigate++;
        if (pageToNavigate > totalPages) pageToNavigate = 1;
        if (pageToNavigate < 1) pageToNavigate = totalPages; 
        if (pageToNavigate === curPage) return;   
        makePage(pageToNavigate);
    });
});

const makePage = (pageNum) => {
    $.ajax({
        type: 'POST',
        url: additional_vars.admin_ajax, // получаем из wp_localize_script()
        data: {
            pageToLoad: pageNum,
            action: 'loadPortfolioPage'
        },
        beforeSend: (xhr) => {
            const inLoadElem = $('<div>', {'class':'in-load'});
            $('.my-portfolio-cards').append(inLoadElem);
            $('.my-portfolio-slider .slider-controller-circle.active').removeClass('active');
        },
        success: (data) => {
            $('.my-portfolio-cards').empty();
            $('.my-portfolio-slider').data('curPageNum', pageNum);
            $(`.my-portfolio-slider .slider-controller-circle[data-page-num="${pageNum}"]`).addClass('active');
            JSON.parse(data).forEach(elem => {
                const cardImageURL = elem['cardImage'];
                const cardTitle = elem['title'];
                const cardContent = elem['content'];
                const cardLink = elem['link'];
                const cardRawHTML = `
                <div class="card my-portfolio-card">
                    <img src="${cardImageURL ? cardImageURL:''}"/>
                    <h4 class="card-headline">${cardTitle}</h4>
                    <input type="hidden" name="content" value="${cardContent}">
                    <input type="hidden" name="link" value="${cardLink}">       
                </div>  
                `
                $('.my-portfolio-cards').append($(cardRawHTML));
            });
            $('.my-portfolio-cards').children('.in-load').remove();
            setPortfolioCardsListener();
        }
    });    
}   