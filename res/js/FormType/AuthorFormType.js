export default AuthorFormType;
import $ from 'jquery';

class AuthorFormType {
    constructor() {
    }

    initialize() {
        $ ( '[data-author-choice]' ).select2 ();
    }
}