<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Apartment;
use App\User;
use App\Service;

class ApartmentsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(Faker $faker)
  {
    $randomHouses = [
      [
        "title" => "Wonderful Home with Balcony close to Colosseo!",
        "address" => "Via delle Terme di Traiano, 4A, 00184 Roma RM",
        "image" => "https://www.casaincontro.it/mythumb.php?h=416&w=555&src=https://www.casaincontro.it/upload/4364_1134.jpg"
      ],
      [
        "title" => "Comfortable And Wonderful Flat Repubblica/Centrale",
        "address" => "Via Gerolamo Morone, 4, 20121 Milano MI",
        "image" => "https://www.casa-fara.it/assets/img/progetto-casa-fara.jpg"
      ],
      [
        "title" => "Single room in the heart of Saint-Germain des Prés",
        "address" => "122 Rue de Grenelle, 75007 Paris, Francia",
        "image" => "https://cdn.marcopolo.tv/880x550/media/post/8dfefge/case-parigi.jpg"
      ],
      [
        "title" => "High Quality Double Room - Next to Oxford Circus!",
        "address" => "23 Gosfield St, Fitzrovia, London W1W 6PJ, Regno Unito",
        "image" => "https://www.londraaltuoservizio.com/wp-content/uploads/2015/02/House-London-e1424683087372.jpg"
      ],
      [
        "title" => "Cozy room with ensuite in Sant Cugat",
        "address" => "Carrer de Sant Cugat del Vallès, 54, 58, 08024 Barcelona, Spagna",
        "image" => "https://www.expat.com/upload/guide/1559543310-1552023312-property-in-barcelona-simona-bottone-shutterstockcom-news-item-slider-news_item_slider-t1559543310.jpg"
      ],
      [
        "title" => "Small Studio Private",
        "address" => "Calle de Velázquez, 83, 28006 Madrid, Spagna",
        "image" => "https://francescocolarieti.com/wp-content/uploads/2018/06/case-in-vendita-a-madrid-1024x576.jpg"
      ],
      [
        "title" => "Douro Roof Top - Amazing terrace & garage",
        "address" => "R. Felicidade Brown 59-3, Porto, Portogallo",
        "image" => "https://pic.le-cdn.com/thumbs/520x390/528/1/properties/Property-6b4567cecade30a9aec423818aa066e4-86108665.jpg"
      ],
      [
        "title" => "Super Central & Quiet Design Apartment",
        "address" => "Oberwallstraße 6, 10117 Berlin, Germania",
        "image" => "https://media.istockphoto.com/photos/beautiful-apartment-houses-in-berlin-germany-picture-id514115738"
      ],
      [
        "title" => "Royal Apartment in center",
        "address" => "Via Ughetti, 39, 95124 Catania CT",
        "image" => "https://www.lacasanelteatro.it/wp-content/uploads/2017/12/foto-Angela-Distefano-13-1240x825.jpg"
      ],
      [
        "title" => "Discover Turin near Porta Susa",
        "address" => "Via Pietro Piffetti, 10143 Torino TO",
        "image" => "https://toscano.azureedge.net/imm/rszo_ec8791ff-703a-4642-8f8d-c6a48dca09ac.jpg"
      ],
      [
        "title" => "Lovely in Venice.",
        "address" => "Campo de la Lana, 620, 30135 Venezia VE",
        "image" => "https://upload.wikimedia.org/wikipedia/commons/0/09/Venezia_-_casa_alle_Zattere.jpg"
      ],
      [
        "title" => "Elegant house homesharing",
        "address" => "Via Lauro de Bosis, 16, 16145 Genova GE",
        "image" => "https://a0.muscache.com/im/pictures/a5f5a7d0-8170-4f17-b7ee-ec02999910d8.jpg?im_w=720"
      ],
      [
        "title" => "Private room next to the main train station",
        "address" => "Mostgasse 5, 1040 Wien, Austria",
        "image" => "https://www.allafinediunviaggio.com/wp-content/uploads/2016/12/cosa-vedere-a-vienna-centro-citta.jpg"
      ],
      [
        "title" => "Santa Croce's Home",
        "address" => "Via di S. Pier Maggiore, 2, 50122 Firenze FI",
        "image" => "https://1click.1clickannunci.it/1ClickAnnunci/foto/2274/pagine/firenze-3_1.jpg"
      ],
      [
        "title" => "CHARMING & LOVE APARTMENT-MONACO MONTE CARLO CITY",
        "address" => "21 Avenue de la Costa, 98000 Monaco",
        "image" => "https://images-1.casa.it/360x265/listing/d9039be103923943c78b71458523b0c6"
      ],
      [
        "title" => "Lovely attic Monza downtown",
        "address" => "Via Antonio Gambacorti Passerini, 13, 20900 Monza MB",
        "image" => "https://images-1.casa.it/360x265/listing/2a9f011b09a12d8ef1c30dfc39413d48"
      ],
      [
        "title" => "Rome Fiumicino Airport&Beach (TempioDellaFortuna)",
        "address" => "Via Stanislao Esposito, 30, 00054 Fiumicino RM",
        "image" => "https://images-1.casa.it/360x265/listing/27d5cae4bef5472e8cb357f9ea44067a"
      ],
      [
        "title" => "TOP FLOOR APARTMENT NEAR HISTORICAL PORTA NOLANA",
        "address" => "Piazza Mercato, 232, 80133 Napoli NA",
        "image" => "https://www.napolimagazine.com/images/490/305/locandine/0/59285462_435861000314499_2703649765001789440_n.jpg"
      ],
      [
        "title" => "My Home in Bologna",
        "address" => "Via delle Donzelle, 6, 40126 Bologna BO",
        "image" => "https://toscano.azureedge.net/imm/rszo_606a0c4c-4463-4ed7-9b83-b8578d7dd4e1.jpg"
      ],
      [
        "title" => "LOW PRICE ROOM IN ROME ..!!",
        "address" => "Via Giuseppe Lunati, 8, 00149 Roma RM",
        "image" => "https://www.romaweekend.it/wp-content/uploads/sites/3/2018/10/acquisto-casa-roma-min-620x340.jpg"
      ],
      [
        "title" => "Naviglio - Design District Suite",
        "address" => "Viale Papiniano, 45, 20123 Milano MI",
        "image" => "https://www.vivereamilano.com/wp-content/uploads/2017/11/casa-afitto-milano.duomo_.jpg"
      ],
      [
        "title" => "Fashion District Modern Loft",
        "address" => "Via del Carmine, 7, 20121 Milano MI",
        "image" => "https://www.milanoweekend.it/wp-content/uploads/2017/09/2017-MW-Crescenzago-ville-ok-620x340.jpg"
      ],
      [
        "title" => "Open Space Loft Navigli Area Milano",
        "address" => "Via Lodovico Il Moro, 91, 20143 Milano MI",
        "image" => "https://toscano.azureedge.net/imm/rszp_b9036957-ecf1-4150-a4f6-879e5bf33b85.jpg"
      ],
      [
        "title" => "Elegant and fully furnished apt in Duomo",
        "address" => "Via Amedei, 8, 20123 Milano MI",
        "image" => "https://img3.idealista.it/blur/WEB_LISTING_TOP/0/id.pro.it.image.master/37/77/1c/232449469.jpg"
      ],
      [
        "title" => "Prestige Loft facing “Bosco Verticale”",
        "address" => "Corso Como, 11, 20124 Milano MI",
        "image" => "https://www.pedestal-eternoivica.com/uploads/images/posts/1887/col12_bosco-verticale-a0941311763418c605b94e7d708c3752.jpg"
      ],
      [
        "title" => "Unique, futuristic loft in the elegant distric.",
        "address" => "Via Topino, 18, 00199 Roma RM",
        "image" => "https://media.gabetti.it/getImage.ashx?f=750/85f52978-1d39-4723-8423-338b379e4a4f-y.jpg&r=c&x=380&y=284&c=FFFFFF&l=2"
      ],
      [
        "title" => "MODERN ROOM near Villa Borghese",
        "address" => "Viale dei Parioli, 45, 00197 Roma RM",
        "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQCp1O27IbEeakZef_fx_K2hcqF_kelhkW0gg&usqp=CAU"
      ],
      [
        "title" => "Design Loft Eur San Pietro e Paolo",
        "address" => "Viale Europa, 327, 00144 Roma RM",
        "image" => "https://db82kmzzne7f2.cloudfront.net/ghost-blogit/2018/04/EUR1.jpg"
      ],
      [
        "title" => "STUDIO 900 ROOM ENSUITE BATHROOM & KITCHEN A/C",
        "address" => "Piazza di Porta Maggiore, 23, Roma RM",
        "image" => "https://www.beliving.it/images/osproperty/properties/277/copy17814925219860fe4f8b5958db18606f528ab05035c91.jpg"
      ],
      [
        "title" => "Historic center Campo dei Fiori",
        "address" => "Via del Corso, 477, 00187 Roma RM",
        "image" => "https://pic.im-cdn.it/image/983545450/xxs-c.jpg"
      ]
    ];

    foreach ($randomHouses as $randomHouse) {

      $randomUser = User::inRandomOrder()->first()->id;

      $newApartment = new Apartment;
      $newApartment->user_id = $randomUser;
      $newApartment->cover_image = $randomHouse["image"];
      $newApartment->bathrooms_number = rand(1, 3);
      $newApartment->beds_number = rand(2, 8);
      $newApartment->square_meters = rand(40, 200);
      $newApartment->description = $faker->realText($faker->numberBetween(150, 500));
      $newApartment->rooms_number = rand(2, 8);
      $newApartment->title = $randomHouse["title"];
      $newApartment->visibility = $faker->boolean(100);
      $newApartment->address = $randomHouse["address"];

      $geocode = file_get_contents('https://api.tomtom.com/search/2/geocode/' . $randomHouse["address"] . '.json?limit=1&key=sVorgm5GUAIyuOOj6t6WLNHniiKmKUSo');
      $output = json_decode($geocode);
      $latitude = $output->results[0]->position->lat;
      $longitude = $output->results[0]->position->lon;

      $newApartment->latitude = $latitude;
      $newApartment->longitude = $longitude;

      $newApartment->save();

      $allServices = Service::all()->count();
      $services = Service::inRandomOrder()->limit(rand(1, $allServices))->get();
      $newApartment->services()->attach($services);
    }



  }
}
