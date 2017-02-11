/***********************************************
***  Methods for the use case updateBook  ******
************************************************/
pl.view.updateBook = {
  setupUserInterface: function () {
    var formEl = document.forms['Book'],
        saveButton = formEl.commit,
        selectBookEl = formEl.selectBook;
    var key="", keys=[], book=null, optionEl=null, i=0;
    // load all book objects
    Book.loadAll();
    // populate the selection list with books
    keys = Object.keys( Book.instances);
    for (i=0; i < keys.length; i++) {
      key = keys[i];
      book = Book.instances[key];
      optionEl = document.createElement("option");
      optionEl.text = book.title;
      optionEl.value = book.isbn;
      selectBookEl.add( optionEl, null);
    }
    // when a book is selected, populate the form with the book data
    selectBookEl.addEventListener("change", function () {
        var book=null, key = selectBookEl.value;
        if (key) {
          book = Book.instances[key];
          formEl.isbn.value = book.isbn;
          formEl.title.value = book.title;
          formEl.year.value = book.year;
        } else {
          formEl.reset();
        }
    });
    saveButton.addEventListener("click", 
        pl.view.updateBook.handleSaveButtonClickEvent);
    window.addEventListener("beforeunload", function () {
        Book.saveAll(); 
    });
  },
  // save data
  handleSaveButtonClickEvent: function () {
    var formEl = document.forms['Book'];
    var slots = { isbn: formEl.isbn.value, 
          title: formEl.title.value, 
          year: formEl.year.value
        };
    Book.update( slots);
    formEl.reset();
  }
};