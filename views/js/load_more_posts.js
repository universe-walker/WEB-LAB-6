document.addEventListener("DOMContentLoaded", () => {
    let load_more_posts_btn = document.querySelector(".main__load-more");

    if(!!load_more_posts_btn) {
        load_more_posts_btn.addEventListener('click', load_more_posts_listener);
    }

    function load_more_posts_listener(e) {
        e.preventDefault();

        let next_page_num = parseInt(e.target.getAttribute('next-page-num'));

        if(isNaN(next_page_num)) {
            next_page_num = 0;
        }

        let url = `${e.target.href}/?page=${next_page_num}`;
        console.log(url);

        let load_more_posts_block = document.querySelector('.main__load-more-wrapper');

        if(!!load_more_posts_block) {
            fetch(url)
            .then(response => response.text())
            .then(result => {
                if(result.length > 0) {
                    load_more_posts_block.insertAdjacentHTML('beforebegin', result);
                    load_more_posts_btn.setAttribute('next-page-num', (next_page_num+1).toString());
                } else {
                    load_more_posts_block.remove();
                }
            })
            .catch(error => console.log(error));
        }
    }
});