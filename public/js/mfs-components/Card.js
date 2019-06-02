class Card {

    constructor() {

        throw new Error('Esta classe não pode ser instânciada')
    }

    static render(card) {

        /* [{icon:'',title:'',text:''},...] */

        let reference_number = Date.now();

        return `
        <div class="${card.classes ? card.classes[0] : 'p-4 hoverable my-2'}" style="height: auto; min-height: 340px">
            ${card.icon ? `
                <div class="p-2 text-center ${card.classes ? card.classes[1] : ''}">
                    <i class="fas fa-${card.icon} my-1 text-primary fs-60"></i>
                </div>`
                : ''
            }
            <div class="p-2 mt-2 text-uppercase text-center fs-25 ${card.classes ? card.classes[2] : ''}">
                <b>${card.title}</b>
            </div>
            <div class="${card.classes ? card.classes[3] : 'p-2 text-center'}">${card.text}</div>
        </div>
        `;
    }
}