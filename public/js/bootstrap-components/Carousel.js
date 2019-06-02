class Carousel {

    constructor() {

        throw new Error('Esta classe não pode ser instânciada')
    }

    static render(size,...slides) {

        /* [{img:'',title:'',text:''},...] */

        let reference_number = Date.now();

        return `
        <div id="c${reference_number}" class="carousel slide" data-ride="carousel" style="background-color:#333333CC">
            <ol class="carousel-indicators">
            ${slides.map((s,i) => `
                <li data-target="#c${reference_number}" data-slide-to="${i}" ${!i ? "class='active'":''}></li>
            `).join('')}
            </ol>
            <div class="carousel-inner">
            ${slides.map((slide,i) => `
                <div style="height:40em" class="carousel-item ${!i ? 'active':''}">
                    <img src="${slide.img}" class="d-inline-block center-xy"
                         style="width: ${size}%; min-height:15em; max-height: 40em">
                    <div class="carousel-caption d-inline-block mx-auto"
                         style="right:0;left:0;bottom:0;background-color:#333333EE;">
                        <h4>${slide.title}</h4>
                        <p>${slide.text}</p>
                    </div>
                </div>
            `).join('')}
            </div>
            <a class="carousel-control-prev" href="#c${reference_number}" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#c${reference_number}" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>`;
    }
}