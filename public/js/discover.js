$( document ).ready(function() {

    const categories = [
        "PHP",
        "Docker",
        "Amazon",
        "Agile",
        "Algorithms"
    ];
    // GET https://www.googleapis.com/books/v1/volumes?q=flowers+inauthor:keyes&key=yourAPIKey

    //Function makes ajax calls
    getBooks = (searchParam) => {
        return $.ajax({
                    url: "https://www.googleapis.com/books/v1/volumes?q=" + searchParam + "API KEY",
                    method: "GET"
                    }).then(function(res) {
                        return res;
                });
    }

    //function for ajax call
    getBookData = (category) => {

        //Creating scroll row for category instance
        let categoryRow = $("<div>");
            categoryRow.addClass("scrollmenu");
            categoryRow.attr("id", category);
            let heading = $("<h2 class=category-heading></h2>").append(category);
            // categoryRow.append(heading);
            $("#row-container").append(heading, categoryRow);

        //Making ajax call for this category
        $.ajax({
            url: "https://www.googleapis.com/books/v1/volumes?q=" + category + "API KEY",
            method: "GET"
            }).done(function(res) {
                //Creating card for each book and appending to scroll row
                for (let i=0; i < res.items.length && i < 15; i++) {
                    let book = res.items[i].volumeInfo;
                    console.log("res: ", book);
                    let card = $("<div data-toggle=modal data-target=exampleModalCenter></div>");
                        card.addClass("book-card");
                        card.attr("id", category + i.toString());
                        card.on("click", function() { addBook(book) });
                        let title = $("<strong>").append(book.title);
                        let author = $("<p>").text(book.authors[0]);
                        let img = $("<img>");
                            img.attr("src", book.imageLinks.thumbnail);
                            img.addClass("bookImg");
                        $(card).append(title, author, img);
                    $("#" + category).append(card);
                }
                //Creating nav link for category once cards appended
                let navItem = $("<li>");
                    navItem.addClass("nav-item");
                    let navLink = $("<a>").append(category);
                        navLink.addClass("nav-link");
                        navLink.attr("href", "#" + category)
                $(navItem).append(navLink);
                $("#discover-nav").append(navItem);
            });
    };

    //Creating category row for each category
    categories.forEach(getBookData);

    //Handle search event
    $("#searchButton").on("click", function() {
        var searchParam = $(":radio[name=searchParam]:checked").val();
        var searchText = $("#searchBox").val();
        getBooks(searchParam).then(function(req) { console.log(req) })
        console.log('hello');

        let searchVal = $("#searchParam").val();
        console.log(searchParam);

    })

    //Handling book click event
    function addBook(book) {
        console.log(book);
        $("#exampleModalCenter").modal("show");
        $("#title").val(book.title);
        $("#author").val(book.authors[0]);
    }
});