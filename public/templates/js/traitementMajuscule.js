function toutMajuscule (champ) {
    champ.value=champ.value.toUpperCase();
}

function  premiereLettreMajuscule(champ) {
    champ.value=champ.value.charAt(0).toUpperCase() + champ.value.substr(1);

}


// var toutMajuscule=function () {
//     this.value=this.value.toUpperCase();
// };
//
// var premiereLettreMajuscule=function () {
//     this.value=this.value.charAt(0).toUpperCase() + this.value.substr(1);
//
// };

// var sousrc_nom=document.getElementById('form_souscr_nomsouscr');
// var assur_nom=document.getElementById('form_assur_v_nom');
// var souscr_prenom=document.getElementById('form_souscr_prenomsouscr');
// var assur_prenom=document.getElementById('form_assur_v_prenom');
//
// var assur_v_nationalite=document.getElementById('form_assur_v_nationalite');
//
//
// if (!(sousrc_nom !== null && souscr_prenom !== null)) {
// } else {
//
//     sousrc_nom.addEventListener('keyup', toutMajuscule);
//     souscr_prenom.addEventListener('keyup', premiereLettreMajuscule);
//
// }
//
// if (assur_nom === null) {
// } else {
//     assur_nom.addEventListener('keyup', toutMajuscule);
//     assur_prenom.addEventListener('keyup', premiereLettreMajuscule);
// }
//
// if (assur_v_nationalite === null) {
// } else {
//     assur_v_nationalite.addEventListener('keyup', toutMajuscule);
// }
//
//
// if (libelleParoisse === null) {
// } else {
//     libelleParoisse.addEventListener('keyup', toutMajuscule);
// }
//
// if (libelleProfession === null) {
// } else {
//     libelleProfession.addEventListener('keyup', premiereLettreMajuscule);
// }
//
// if (libelleEvenement === null) {
// } else {
//     libelleEvenement.addEventListener('keyup', premiereLettreMajuscule);
// }
//
// if (libelleFonction === null) {
// } else {
//     libelleFonction.addEventListener('keyup', premiereLettreMajuscule);
// }

