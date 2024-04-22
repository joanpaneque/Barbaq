<script setup></script>

<template>
    <div class="grid-aside">
        <div class="baskets">
            <h1>
                CISTELLA</h1>
            <div class="img">
                <img src="assets/img/foodbaskets.png" alt="Cistella" class="img-fluid">
            </div>
        </div>
        <div class="dates">
          
            <h1>24 d'abril de
                <br>
                2021
            </h1>
            <h2>
                12:00h
            </h2>
        </div>
        <div class="maps">
            <img src="assets/img/map.png" alt="Mapa" class="img-fluid">
        </div>
        <div class="costs">
            <div class="top">
                <h1>COSTOS</h1>

                <div class="total">
                    <p>Total</p>
                    <h1>25 <span>€</span></h1>
                </div>
            </div>

            <div class="bottom">

                <img src="assets/img/money.png" alt="Targeta de crèdit" class="img-fluid">

                <div class="pay">
                <p>A pagar</p>
                <h1>25 <span>€</span>

                </h1>
            </div>
            </div>
        </div>
        <div class="users">
            <h1>USUARIS</h1>

            <div class="usersdiv">
            <p>
                Veure tots els usuaris inscrits
            </p>

            <img src="assets/svg/arrow-right.svg" alt="Fletxa dreta" class="img-fluid">
        </div>
        </div>
    </div>
</template>

<style scoped>
.baskets {
    grid-area: baskets;
    width: 100%;
    background: rgb(255, 189, 148);
    background: linear-gradient(140deg, rgba(255, 189, 148, 1) 0%, rgba(255, 97, 0, 1) 100%);
    border-radius: 10px;
    cursor: pointer;


    h1 {
        font-size: 1.5rem;
        color: #9B3B00;
        font-weight: bold;
        margin-left: 5px;
        padding-left: 15px;
        padding-top: 10px;
    }

    img {
        width: 250px;
    }

    .img {
        display: flex;
        justify-content: flex-end;
        padding-right: 10px;
        padding-bottom: 10px;
    }

}

.dates {
    grid-area: dates;
    background: rgb(255, 255, 255);
    background: linear-gradient(140deg, rgb(223, 248, 255) 0%, rgb(44, 181, 215) 100%);
    padding: 15px;
    width: 100%;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    cursor: pointer;

    h1 {
        font-size: 1.6rem;
        color: #073e48;
        font-weight: bold;
        text-align: center;
    }

    h2 {
        font-size: 1.2rem;
        color: #000000;
        font-weight: bold;
    }

    
}

.maps {
    grid-area: maps;
    border-radius: 10px;
    cursor: pointer;
    width: 100%;
    height: 100%;
}

.costs {
    grid-area: costs;
    background: rgb(57, 255, 0);
    background: linear-gradient(140deg, rgba(57, 255, 0, 1) 0%, rgba(255, 235, 0, 1) 100%);
    padding: 10px;
    width: 100%;
    border-radius: 10px;
    cursor: pointer;

    .top{
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 10px;
        line-height:1em;

        h1 {
            font-size: 1.5rem;
            color: #0D5C00;
            font-weight:bolder;
        }

        .total {
            display: flex;
            flex-direction: column;
            align-items: center;

            p {
                font-size: 0.9rem;
                color: #ff5e00;
                font-weight: bolder;
            }

            h1 {
                font-size: 1rem;
                color: #0D5C00;
                font-weight: bolder;
            }
        }
    
    }

    .bottom {
        display: flex;
        align-items: center; 
        justify-content: center;
        padding-top: 10px;
        padding-right: 40px;
        padding-bottom: 10px;
        line-height: 2em;
        gap: 30px;

      
        .pay {
            display: flex;
            flex-direction: column;
            align-items: center;

            p {
            font-size: 1rem;
            color: #ff5e00;
            font-weight: bolder;
            padding-right:35px;
        }

        h1 {
            font-size: 3rem;
            color: #0D5C00;
            font-weight: bolder;
        }

        }

        img{
           rotate: -15deg;
           padding-left: 30px;
           width: 120px;
        }

    }
}

.users {
    grid-area: users;
    background: rgb(192, 0, 255);
    background: linear-gradient(140deg, rgb(173, 129, 188) 0%, rgb(206, 84, 204) 100%);
    padding: 10px;
    width: 100%;
    border-radius: 10px;
    cursor: pointer;

    h1 {
        font-size: 1.5rem;
        color: #4e003d;
        font-weight: bold;
        text-align: start;
        padding-left: 15px;
    }

    .usersdiv {
        display: flex;
        justify-content:flex-start;
        align-items: center;
        padding: 10px;
        gap: 10px;

        p {
            font-size: 1rem;
            color: #340029;
            font-weight: bold;
        }

        img {
            width: 20px;
        }
    }

    .usersdiv:hover {
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 10px;
    
    }
}



.grid-aside {
    display: grid;
    grid-template-areas:
        'baskets baskets'
        'dates maps'
        'costs costs'
        'users users';
    grid-gap: 10px;
    padding: 10px;
    width: 100%;
    height: 100%;
}
</style>