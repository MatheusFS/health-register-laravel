CardCollection.render('#card-collection', {
    icon: "home",
    title: "Dashboard",
    text: "As principais informações do seu negócio, disponíveis em gráficos e resumos"
}, {
        icon: "user-md",
        title: "Clientes",
        text: "Ficha de cadastro, anamneses, anotações, atestados, receituários, galeria de imagens e documentos"
    }, {
        icon: "calendar",
        title: "Agenda",
        text: "Controle das consultas e dos retornos. Diminuição das faltas e agenda configurável por profissional"
    }, {
        icon: "newspaper",
        title: "Prontuario",
        text: "Acesso às informações de seus pacientes com segurança.Orçamento integrado para cobrança de consultas e procedimentos."
    }, {
        icon: "money-bill-wave",
        title: "Financeiro",
        text: "As principais informações do seu negócio, disponíveis em gráficos e resumos"
    }, {
        icon: "bullhorn",
        title: "Marketing",
        text: "Ficha de cadastro, anamneses, anotações, atestados, receituários, galeria de imagens e documentos"
    }, {
        icon: "clipboard",
        title: "Relatórios",
        text: "Controle das consultas e dos retornos. Diminuição das faltas e agenda configurável por profissional"
    }, {
        icon: "cog",
        title: "Ferramentas",
        text: "Acesso às informações de seus pacientes com segurança.Orçamento integrado para cobrança de consultas e procedimentos."
    });

CardCollection.render('#card-collection2', {
    classes: ['p-0 shadow mt-4', null, 'p-4 text-info bg-light', 'p-0'],
    title: "Light Mensal",
    text: `<div class='p-3'>
            <p>2 Usuários<br><small>(adicionais podem ser contratados)</small></p>
            <p>Agenda / Prontuário / Financeiro</p>
            <p>Painel Administrativo</p>
            <p>Espaço ilimitado para imagens</p>
            <p>Aplicativo para iOS/Android</p>
            <p>Maquininha de Cartão de Crédito/Débito</p>
            <p>Suporte Ilimitado</p>
          </div>
          <div class='bg-info text-light p-3 fs-20'>
            R$ <b class='fs-45'>79,90</b>/mês
          </div>`,
}, {
        classes: ['p-0 shadow mt-0', null, 'p-4 text-danger bg-light', 'p-0'],
        title: "Plus Mensal",
        text: `<div class='p-3'>
            <p>3 Usuários<br><small>(adicionais podem ser contratados)</small></p>
            <p>Plano Light +</p>
            <p>Módulo Marketing<br><small>(Campanha de e-mail marketing e SMS automático)</small></p>
            <p>Módulo Chat<br><small>(Comunicação interna com sua equipe)</small></p>
            <p>100 créditos mensais de SMS</p>
          </div>
          <div class='bg-danger text-light p-3 fs-20'>
            R$ <b class='fs-45'>99,90</b>/mês
          </div>`,
    }, {
        classes: ['p-0 shadow mt-4', null, 'p-4 text-info bg-light'],
        title: "Pro Mensal",
        text: `<div class='p-3'>
            <p>5 Usuários <br><small>(adicionais podem ser contratados)</small></p>
            <p>Plano Plus +</p>
            <p>Módulo Boleto<br><small>(Emissão de boletos com taxas diferenciadas)</small></p>
            <p>Módulo Clínica<br><small>(Controles de Cheque e Cartão)</small></p>
            <p>200 Créditos Mensais de SMS</p>
          </div>
          <div class='bg-info text-light p-3 fs-20'>
            R$ <b class='fs-45'>139,90</b>/mês
          </div>`,
    });

Css.bind_margin_top('#indexNav', '#indexCarousel');

$(window).scroll(() => {
    if ($(window).scrollTop()) {
        $("#indexNav").addClass('bg-light navbar-light');
        $("#indexNav").removeClass('navbar-dark');

        $("#indexNav .navbar-text button").removeClass('text-light');
    } else {
        $("#indexNav").addClass('navbar-dark');
        $("#indexNav").removeClass('bg-light navbar-light');

        $("#indexNav .navbar-text button").addClass('text-light');
    }
});

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});