<?php
// Memulai sesi
session_start();

// Mengimpor file koneksi database
include 'includes/db.php';

// Memeriksa apakah tabel 'films' ada
$checkTable = "SHOW TABLES LIKE 'movies'";
$tableExists = mysqli_query($conn, $checkTable);

if (mysqli_num_rows($tableExists) == 0) {
    echo "Tidak ada data film yang tersedia saat ini";
} else {

// Mendapatkan data film dari database
    $sql = "SELECT * FROM movies";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
    die("Kesalahan dalam query: " . mysqli_error($conn));

    }
}    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineVerse</title>
    <link rel="stylesheet" href="assets/style.css" />

    <link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Chivo+Mono:wght@300&family=Inter:wght@300;400;500;600;700;800;900&family=Oswald&family=Poppins:ital,wght@1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

        <header>
            <a href="#" class="logo">CineVerse</a>
            <div class="bx bx-menu" id="menu_icon"></div>

            <ul class="navbar">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </header>

        <!-------home start------->
        <section class="home" id="home">
            <div class="home-text">
                <h1>Cineverse</h1>
                <h2>Rangkuman <br> Film </h2>
                <a href="#" class="btn">Chit Chat</a>
            </div>

            <div class="home-img">
                <img src="img/cinemalogo.jpg">
            </div>
        </section>

        <!-------about start------->
        <section class="about" id="about">
            <div class="about-img">
                <img src="img/clapperboard.jpg">
            </div>

            <div class="about-text">
                <span>About Us</span>
                <h2>We gathered the <br> film enthusiast</h2>
                <P>"Di mata seorang film enthusiast, setiap film adalah sebuah karya seni yang menunggu untuk ditemukan dan dinikmati sepenuhnya."</P>
                <a href="#" class="btn">Learn More</a>

            </div>
        </section>

        <!-------menu start------->
        <section class="menu" id="menu">
            <div class="heading">
                <span>Movies List</span>
                <h2>Great Movie, Great Mood</h2>
            </div>

            <div class="menu-container">
                <?php while ($film = mysqli_fetch_assoc($result)) { ?>
                <div class="box">
                    <div class="box-img">
                        <img src="<?php echo $film['image']; ?>" alt="Movie Image">
                    </div>
                    <h2><?php echo $film['title']; ?></h2>
                    <h3><?php echo $film['director']; ?></h3>
                    <span><?php echo $film['id']; ?></span>    
                </div>
                <?php } ?> 

                <div class="box">
                    <div class="box-img">
                        <img src="img/ff2.jpg">
                    </div>
                    <h2>2 Fast 2 Furious</h2>
                    <h3>John Singleton</h3>
                    <span>2</span>
                    
                </div>
            </div>

            <div class="box">
                <div class="box-img">
                    <img src="img/tokyo drift.jpg">
                </div>
                <h2>The Fast And The Furious: Tokyo Drift</h2>
                <h3>Justin Lin</h3>
                <span>3</span>
                
            </div>

            <div class="box">
                <div class="box-img">
                    <img src="img/ff4.jpg">
                </div>
                <h2>Fast And Furious</h2>
                <h3>Justin Lin</h3>
                <span>4</span>
                
            </div>
        </section>

        <section class="services" id="services">
            <div class="heading">
                <span>Services</span>
                <h2>We have collected some good films</h2>
            </div>

            <div class="service-container">
                <div class="s-box">
                    <img src="img/director.png">
                    <h3>Director</h3>
                    <P>orang yang bertugas mengarahkan sebuah film sesuai dengan manuskrip, pembuat film juga digunakan untuk merujuk pada produser film. Manuskrip skenario digunakan untuk mengontrol aspek-aspek seni dan drama. Pada masa yang sama, sutradara mengawal petugas atau pekerja teknik dan pemeran untuk memenuhi wawasan pengarahannya. Seorang sutradara juga berperan dalam membimbing kru teknisi dan para pemeran film dalam merealisasikan kreativitas yang dimilikinya.</P>
                </div>

                <div class="s-box2">
                    <img src="img/universal.png">
                    <h3>Produced By</h3>
                    <P>Universal Pictures (juga dikenal sebagai Universal Studios, dan sebelumnya Universal Manufacturing Company) adalah studio film Amerika yang dimiliki oleh Comcast melalui divisi Universal Filmed Entertainment Group dari anak perusahaannya yang sepenuhnya dimiliki NBCUniversal.</P>
                </div>

                <div class="s-box">
                    <img src="img/usanobg.png">
                    <h3>Country</h3>
                    <P>USA adalah negara republik konstitutional federal yang terdiri dari lima puluh negara bagian dan sebuah distrik federal dan usa merupakan salah satu negara dengan industri film terbesar di dunia</P>
                </div>
            </div>
        </section>

           

        <!-------call to action------->
        <section class="cta">
            <h2>"Fast and Furious adalah serangkaian film aksi yang menampilkan balapan mobil jalanan, pencurian, dan misi rahasia. Dimulai pada tahun 2001, seri ini telah berkembang menjadi salah satu waralaba film terbesar di dunia, dengan jutaan penggemar yang setia. Bergabunglah dengan Dominic Toretto, Brian O'Conner, Letty Ortiz, dan anggota tim lainnya dalam petualangan menegangkan yang menguji batas kecepatan, persahabatan, dan keluarga."<br></h2>
            <a href="#" class="btn">Chit Chat</a>
        </section>

        <!-------footer start------->
        <section id="contact">
            <div class="footer">
                <div class="main">
                    <div class="col">
                        <h4>Menu Links</h4>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Menu</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Contact</a></li>

                        </ul>
                    </div>

                </div>
            </div>
        </section>


    <!-------footer start------->
    <script type="text/javascript" src="assets/script.js"></script>
    
    
</body>
</html>

