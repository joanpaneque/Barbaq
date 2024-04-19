<script setup>
</script>

<template>
    <div class="container px-6 py-3">
        <div class="header flex items-center justify-between pb-5">
            <div class="left flex items-center">
                <img src="/assets/svg/user.svg" alt="User" class="w-10 mr-2">
                <div>
                    <h3 class="font-bold">Aniol Moreno Batlle</h3>
                    <div class="flex items-center">
                        <img src="/assets/svg/marcador.svg" alt="Marcador" class="w-3 mr-1">
                        <p class="text-sm">L'Estartit</p>
                    </div>
                </div>
            </div>

            <p class="right text-sm">12 de abril a les 21:25</p>
        </div> 

        <div class="content pb-3">
            <h1 class="text-3xl font-bold">Barbacoa dels cardats</h1>

            <p>
                Una barbacoa és una trobada entre amics o família en què es cuina a l'aire lliure, generalment al voltant d'una graella o un forn de carbó. És una tradició popular en moltes cultures, on es preparen diverses menes de carn, verdures i altres aliments que es cuinen lentament sobre les flames, proporcionant un sabor distintiu i aromàtic. És una ocasió per gaudir del bon temps, la companyia i la gastronomia alhora.
            </p>

            <div class="images flex pt-3 gap-2">
                <div class="w-full max-w-1/2">
                    <img src="/assets/img/barbaquiu1.jpg" alt="Barbaquiu 1" class="object-cover w-full h-32">
                </div>
                <div class="w-full max-w-1/2">
                    <img src="/assets/img/barbaquiu2.jpg" alt="Barbaquiu 2" class="object-cover w-full h-32">
                </div>
            </div>
        </div>



        <div class="linia" />

        <div class="bottom">
            <div class="pb-2">
                <div class="flex items-center justify-between pt-5 pb-2">
                    <div class="left flex items-center">
                        <img src="/assets/svg/user.svg" alt="User" class="w-8 mr-2">
                        <h4 class="font-bold">Roman Mysyura</h4>
                    </div>

                    <p class="right text-sm">13 de abril a les 15:07</p>
                </div>

                <p class="text-sm">
                    Jo m'apunto 100%, tinc moltes ganes ya, per fi s'ha acabat el ramadan! 🤣
                </p>
            </div>


            <div class="comentaris">
                <p class="font-bold text-xs">Mostrar més comentaris</p>

                <div class="flex items-center py-2">
                    <img src="/assets/svg/user.svg" alt="User" class="w-8 mr-2">
                    
                    <textarea
                        type="text" 
                        id="comentari" 
                        name="coment" 
                        placeholder="Escriu un comentari"
                        class="mr-2 w-full h-[40px] resize-none"
                    />

                    <button class="">
                        Enviar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.container {
    background-color: #fff;
    border-radius: 20px;
}

.right {
    color: #A6A6A6;
}

.images img {
    border-radius: 5px;
}

.linia {
    height: 1px;
    background-color: #CECECE;
}

textarea,
button {
    background-color: #DEDEDE;
    border-radius: 5px;
    padding: 0.5rem;
}
</style>