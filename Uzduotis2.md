### Užduotis

1. Sukurti CRUD’a News (index, show, create, edit, delete) su notification’ais ir validation’ais.

Privalomi laukai:
    - title
    - active

DB Schema:

- news
  — id INT 11
  — title VARCHAR 255
  — description TEXT
  — active BOOL
  — created_at
  — updated_at

2. Sukurti table Category ir prideti relations’a prie News (One to Many). Paredaguoti News pridedant Category. 
   News liste isvesti kategorijos pavadinima. Edit ir create turi buti galimybe pasirinkti kategorija.
- category
  — id INT 11
  — title VARCHAR 255
  — created_at
  — updated_at

3. Sukurti Event’a, kuris skaiciuotu kiek kartu buvo atidarytas News irasas (show).

4. Paredaguoti News ir padaryti funkcionaluma, kad butu galima prideti paveiksliuka prie news iraso. 
   Isvesti News list’e paveiksliuka. Naudojam file storage.

5. Implementuoti cache ant show method’o (galima naudoti cache DB arba Redis). Ant update isvalyti cache key.

6. Implementuoti logika, kuri sukurus nauja News irasa issiutu el.laiska su News data.

7. Sukurti komanda (scheduler’i) kuris paimtu sios dienos sukurtas naujienas ir issiustu mail’a su naujienu list’u, panaudoti workerius.

8. Parasyti API endpoint’a, kuris grazintu visu naujienu list’a json’u ir endpointa, kuris grazintu viena naujiena, padavus news id.
