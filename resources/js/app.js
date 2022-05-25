require('./bootstrap');

$(document).ready(function () {
    $('select').select2();
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
        category_id: ""
    };

    const searchTrigger = document.getElementById('search');
    const searchName = document.getElementById('name');
    const searchAuthor = document.getElementById('author');
    const searchCategory = document.getElementById('category');

    searchTrigger.addEventListener('click', function () {
        searchParams.name = searchName.value;
        searchParams.author = searchAuthor.value;
        searchParams.category_id = searchCategory.value;

        renderList(searchParams)
    });
}

function renderList(searchParams) {
    axios.get('http://localhost/books-list', { params: searchParams }).then(resp => {
        const books = resp.data.books;

        bookContainer.innerHTML = '';

        for (let i = 0; i < books.length; i++) {
            const book = books[i];
            let message = "<div>Name: " + book.name + " | SKU:" + book.sku + "</div>";

            bookContainer.innerHTML += message;
        }
    });
}
