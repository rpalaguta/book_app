<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About project

BookApp - perskaitytu knygų marketplace'as.

## Funkcionalumas

#### User dalis.

- Knygų sąrąšas:
    - Filtravimas pagal:
        - Kategoriją
        - Kalbą
    - Paieška  pagal:
        - Pavadinimą
        - IBAN
        - Kategoriją
        - Autoriu
    - Naujausios knygos -> [sortBy : createdAt ]
    - Naujausios parduotos knygos
    - Daugiausiai ieškomos knygos
- Peržiūrėti knygos informaciją
  - Išvesti sąrašą vartotojų, kurie siūlo įsigyti knygą
  - Įsidėti knygą į krepšelį.
  - Perskaityti komentarus apie knygą
- Prisijungęs vartotojas, gali:
    - Įtraukti knygą į pageidaująmų sąrašą
    - Peržiūrėti pageidaujamų knygų sąrašą
    - Peržiūrėti savo užsakymų istoriją
    - Pateikti knygą pardavimui
    - Peržiūrėti gautus užsakymus

#### Admin dalis

- Prisijungęs vartotojas su admin teisėmis, gali:
    - Sukurti knygą, priskirti kategoriją(-as), priskirti autorių(-ius)
    - Sukurti naują kategoriją
    - Sukurti naują autorių
    - Redaguoti esamą knygą // isigyvendint
    - Ištrinti knygą (soft delete)
    - Peržiūrėti registruotus vartotojus, sukurti naują, redaguoti, blokuoti, ištrinti vartotoją //MANY TO MANY Role
    - Sukurti redaguoti kategorijų sąrašą.
    - Peržiūrėti visus užsakymus. //
    - Peržiūrėti pageidaujamų knygų sąrašą. //

#### DB

- users
- books
- categories
- book_comments
