import $ from 'jquery';

class Search{
    // This is the constructor method that runs when the class is instantiated
    constructor(){
   this.openButton = $('.js-search-trigger')
   this.closeButton = $('.search-overlay__close')
    this.searchOverlay = $('.search-overlay')
    this.events()
}
//events
events(){
    this.openButton.on('click', this.openOverlay.bind(this))
    this.closeButton.on('click', this.closeOverlay.bind(this))
    $(document).on('keyup', this.keyPressDispatcher.bind(this))
}
//methods functions and actions
keyPressDispatcher(e){
    if(e.keyCode == 27){
        this.closeOverlay()
    }
    if(e.keyCode == 83 && !$('input').is(':focus') && !$('textarea').is(':focus')){
        this.openOverlay()
    }
}
openOverlay(){
   this.searchOverlay.addClass('search-overlay--active')
   $('body').addClass('body-no-scroll')
   
}
closeOverlay(){
    this.searchOverlay.removeClass('search-overlay--active')
    $('body').removeClass('body-no-scroll')
}
}

export default Search