<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"
integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0"
crossorigin="anonymous"></script>
<style>

    body{
        background-color: #ccc;
    }

    .grid-4{
        display: grid;
        padding: calc(8vw / 6);
        grid-gap: calc(8vw / 6);
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    }

    .center-flex{
        display:flex;
        justify-content:center;
        align-items:center;
    }

    .input-button{
        font-size: 2.5rem;
    }
    .input-button>input{
        background-color: #00000000;
        color: #FFF;
        border: 0;
        border-bottom: 2px solid #FFF;
        text-align: center;
    }

</style>