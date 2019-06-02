class Css {

    constructor() {

        throw new Error('Esta classe não pode ser instânciada')
    }

    static bind_margin_top(target, ...elements) {

        target = document.querySelector(target);

        function applyMargin(){
            elements.forEach(element => $(element).css('margin-top', target.offsetHeight + 'px'));
        }

        applyMargin();
        window.addEventListener("resize", applyMargin);
    }

}