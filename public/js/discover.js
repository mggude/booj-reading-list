$( document ).ready(function() {

    const categories = [
        "software",
        "webdesign",
        "coding",
        "data",
        "algorithms"
    ];

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
            }).then(function(res) {
                //Creating card for each book and appending to scroll row
                console.log("res: ", res);
                for (let i=0; i < res.items.length && i < 15; i++) {
                    let book = res.items[i].volumeInfo;
                    let card = $("<div data-toggle=modal data-target=formModal></div>");
                        card.addClass("book-card");
                        card.attr("id", category + i.toString());
                        card.on("click", function() { addBook(book) });
                        let title = $("<h4>").append(book.title);
                        let author = $("<p>").append(book.title);
                        let img = $("<img>");
                            img.attr("src", book.imageLinks.thumbnail); 
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

    //Adding an on-click function to each card to add to database
    function addBook(book) {
        console.log(book);
        $("#addTitle").val("hello");
    }
});