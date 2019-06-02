class CardCollection {

    constructor() {

        throw new Error('Esta classe não pode ser instânciada')
    }

    static render(element_id,...cards) {

        console.log(cards.forEach(card => `<div class="col">${Card.render(card)}</div>`));
        let DOMElement = document.querySelector(element_id);

        DOMElement.innerHTML = `
        <div class=''>
            <div class="row">
                ${cards.map(card => `
                    <div class="col-12 col-md-4 col-lg-${cards.length > 3 ? '3' : '4'}">${Card.render(card)}</div>
                `).join('')}
            </div>
        </div>
        `;
    }
}