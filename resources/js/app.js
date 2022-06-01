require('./bootstrap');
require('./auction');

$(document).ready(function () {
    // $('select').select2();
});

const bookContainer = document.getElementById('bookContainer');

if (bookContainer) {
    renderList({});
    //1 pagauti event
    //2 patikrinti ar name value yra
    //3 isnaujo isrenderinti duomenis

    let searchParams = {
        name: "",
        author: "",
        category_id: "",
        language: "",
        sort_by: "",
        category_name: ""
    };

    const searchTrigger = document.getElementById('search');
    const searchName = document.getElementById('name');
    const searchCategoryName = document.getElementById('category_name');
    const searchAuthor = document.getElementById('author');
    const searchCategory = document.getElementById('category');
    const searchLanguage = document.getElementById('language');
    const sortBy = document.getElementById('sort');

    searchTrigger.addEventListener('click', function () {
        searchParams.name = searchName.value;
        searchParams.author = searchAuthor.value;
        searchParams.category_id = searchCategory.value;
        searchParams.language = searchLanguage.value;
        searchParams.sort_by = sortBy.value
        searchParams.category_name = searchCategoryName.value

        renderList(searchParams)
    });
}

function renderList(searchParams) {
    axios.get('http://localhost/books-list', { params: searchParams }).then(resp => {
        const books = resp.data.books;

        let content = '<table class="table">' +
            '  <thead>' +
            '    <tr>' +
            '      <th scope="col">Name</th>' +
            '      <th scope="col">Sku</th>' +
            '      <th scope="col">Category</th>' +
            '      <th scope="col">Language</th>' +
            '      <th scope="col">Viewed count</th>' +
            '    </tr>' +
            '  </thead>' +
            '  <tbody>';

        for (let i = 0; i < books.length; i++) {
            const book = books[i];

            let message = '<tr>' +
                '      <td>' + book.name + '</td>' +
                '      <td>' + book.sku + '</td>' +
                '      <td>' + book.category_name + '</td>' +
                '      <td>' + book.language + '</td>' +
                '      <td>' + book.viewed_count + '</td>' +
                '    </tr>'

            content += message;
        }

        content  +=
            "</tbody>" +
        "</table>";

        bookContainer.innerHTML = content;
    });
}
