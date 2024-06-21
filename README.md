# DIANETACADEMY
Tema acestei lucrări de licență se concentrează pe dezvoltarea și implementarea unui sistem web interactiv destinat educației în domeniul programării.
 Această aplicație are funcționalități esențiale pentru un proces de învățare eficient și adaptabil pentru orice persoană ce se află în căutarea de cunoaștere:
 - Creearea unui cont atât de utilizator, cât și pentru admin;
 - Autentificarea contului în urma înregistrării;
- Vizualizarea cursurilor disponibile;
- Galeria unde se regăsesc atât videoclipuri cât și poze relevante;
- Sesiuni live difuzate prin intermediul aplicației web;
-Posibilitatea de a aplica la oricare dintre cursuri;

Adminul este singurul ce are acces la modifcarea cursurilor, a datelor personale despre aplicanții înscriși la sesiunile live, cât și a utilizatorilor ce își creează cont pe aplicație. Aceste schimbări se fac din panou control.
De menționat că atâta timp cât nu vă creați cont, nu puteți să vă înscrieți la sesiunile live. Conceptul a fost făcut în așa fel încât orice vizitator să poată vedea cursurile disponibile, dar pentru a accesa pagina de sesiuni live, este obligatoriu crearea unui cont și abia apoi aplicarea la cursul dorit.  Crearea unui cont se face pe bază de nume, adresă de email, aceasta trebuie să fie una existentă, și parolă. După apăsarea butonului de înregistrare, trebuie confirmată adresa de email. Astfel, te va redirecționa dupa autentificare pe pagina principală.
Înscrierea pentru sesiunile live se face pe bază de nume, adresă de email, număr de telefon, id-ul discord-ului, pentru a fi la zi cu noile discuții, implementări, cât și problemele pe care le pot întâmpina ceilalți participanți la rezolvarea exercițiilor. După aceea, se selectează cursul dorit și veți primi pe adresa de email detaliile despre cursul, zilele în care se vă desfășura și orele acestuia, cu un link care duce către pagina de sesiuni live. 
Astfel, în cazul în care ați uitat la ce curs v-ați înscris, sau detalii despre acesta, puteți să vă accesați adresa de email și să gasiți acolo toate detaliile. 
A doua variantă este să  vă autentificați pe contul personal și acolo aveți posibilitatea să vedeți toate cursurile la care ați aplicat.
Așadar, această aplicație web a fost concepută pentru a veni în ajutor asupra tinerilor care doresc să o iau de la zero, având posibilitatea de a învăța tot ce doresc și având acces la cursuri de toate nivelurile: începători, intermediari și avansați.

În aplicația mea web, pentru administrarea unei școli de programare, am folosit un server local și anume: XAMPP care include HTTP Server, MySQL, PHP.HTTP (Hypertext Transfer Protocol) este un protocol ce realizează comunicația între clienți și servere pe internet, prin care se permite transferul de date.

De instalat:
 -XAMPP Control Panel - pentru server-ul local.
 -Composer - pentru trimiterea de mail-uri.
 

 Pasii de compilare:
 - Se deschide Xampp si se pornesc  MYSQL si APACHE;
 - Se deschide din bara de navigare din Google sau oricare alta sursa de internet accesand : localhost/acasa - pentru a ajunge pe pagina principala a site-ului
 - Si pentru a intra pe pagina de administrator se va introduce : localhost/phpmyadmin

 Link-ul catre tot proiectul cu toate fisierele este urmatorul: https://github.com/DiandraRosca/DIANETACADEMY    
