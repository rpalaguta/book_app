const auctionSpa = document.getElementById('auction_spa');

if (auctionSpa) {
    let auction = {
        book_id: "",
        quantity: "",
        price: "",
        enabled: "",
    };

    const auctionTrigger = document.getElementById('trigger'),
        book = document.getElementById('book_id'),
        quantity = document.getElementById('quantity'),
        price = document.getElementById('price'),
        enabled = document.getElementById('enabled');

    auctionTrigger.addEventListener('click', function () {
        auction.book_id = book.value;
        auction.quantity = quantity.value;
        auction.price = price.value;
        auction.enabled = enabled.checked;

        console.log(auction);

        const headers = {
            'content-type': 'application/json',
           // 'Authorization': 'Bearer 9|kJbq1ozWtlIOYmtSN2yWaCMZTsN68JrcnbcqOB8t'
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        };

        axios.post('/api/auctions', auction, { headers: headers })
            .then(function (response) {
                console.log(response);
                const successContainer = document.getElementById('success');

                book.value = null;
                quantity.value = 0;
                price.value = 0;
                enabled.checked = false;

                successContainer.innerHTML = 'Aukcionas pridėtas sėkmingai';
            })
            .catch(function (error) {
                console.log(error.response.status);
                console.log(error.response.data);
                if (error.response.status === 401) {
                    const errorContainer = document.getElementById('error');

                    errorContainer.innerHTML = error.response.data.message;
                }
            });
    });
}
