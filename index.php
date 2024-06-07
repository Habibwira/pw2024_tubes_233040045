<?php
include 'includes/session.php';
include 'includes/db.php';

// Mendapatkan data film dari database dengan fitur pencarian
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $stmt = $conn->prepare("SELECT * FROM movies WHERE film LIKE ? OR genre LIKE ? OR actors LIKE ? OR directors LIKE ?");
    $search_param = '%' . $search . '%';
    $stmt->bind_param('ssss', $search_param, $search_param, $search_param, $search_param);
} else {
    $stmt = $conn->prepare("SELECT * FROM movies");
}

$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
    die("Kesalahan dalam query: " . $conn->error);
}

$isAdmin = isAdmin();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineVerse</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Chivo+Mono:wght@300&family=Inter:wght@300;400;500;600;700;800;900&family=Oswald&family=Poppins:ital,wght@1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
   <style>
    .box-img img {
     width: 100%;
     height: auto;
     max-width: 200px;
     max-height: 300px;
     object-fit: cover;
 }
   </style>
</head>

<body>
<header>
    <a href="#" class="logo">CineVerse</a>
    <div class="bx bx-menu" id="menu_icon"></div>

    <ul class="navbar">
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#menu">Menu</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#contact">Contact</a></li>
        <?php if ($isAdmin): ?>
            <li><a href="admin/create.php">Add film</a></li>        
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</header>

<?php if ($isAdmin): ?>
    <!-- Halaman Admin -->
    <section class="admin">
        <h1>Admin Panel</h1>
        <form method="GET" action="index.php">
            <input type="text" name="search" placeholder="Cari film..." value="<?php echo htmlspecialchars($search); ?>">
            <input type="submit" value="Cari">
        </form>

        <div class="menu-container">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($film = $result->fetch_assoc()): ?>
                    <div class="box">
                        <div class="box-img">
                            <a href="detail.php?id=<?php echo $film['id']; ?>">Detail</a>
                            <img src="assets/img/<?php echo htmlspecialchars($film['image']); ?>" alt="Movie Image">
                        </div>
                        <h2><?php echo htmlspecialchars($film['film']); ?></h2>
                        <h3><?php echo htmlspecialchars($film['directors']); ?></h3>
                        <span><?php echo htmlspecialchars($film['genre']); ?></span>
                        <a href="admin/update.php?id=<?php echo $film['id']; ?>">Edit</a>
                        <a href="admin/delete.php?id=<?php echo $film['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus film ini?')">Delete</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Tidak ada data film yang tersedia saat ini.</p>
            <?php endif; ?>
        </div>
    </section>

<?php else: ?>
    <!-- Halaman Pengunjung -->
    <section class="home" id="home">
        <div class="home-text">
            <h1>Cineverse</h1>
            <h2>Rangkuman <br> Film </h2>
            <a href="#" class="btn">Chit Chat</a>
        </div>
        <div class="home-img">
            <img src="assets/img/cinemalogo.jpg" alt="cinema logo">
        </div>
    </section>

    <form method="GET" action="index.php">
        <input type="text" name="search" placeholder="Cari film..." value="<?php echo htmlspecialchars($search); ?>">
        <input type="submit" value="Cari">
    </form>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="about-img">
            <img src="assets/img/clapperboard.jpg" alt="Clapperboard">
        </div>
        <div class="about-text">
            <span>About Us</span>
            <h2>We gathered the <br> film enthusiast</h2>
            <p>"Di mata seorang film enthusiast, setiap film adalah sebuah karya seni yang menunggu untuk ditemukan dan dinikmati sepenuhnya."</p>
            <a href="#" class="btn">Learn More</a>
        </div>
    </section>

    <!-- Menu Section -->
    <section class="menu" id="menu">
        <div class="heading">
            <span>Movies List</span>
            <h2>Great Movie, Great Mood</h2>
        </div>
        <div class="menu-container">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($film = $result->fetch_assoc()): ?>
                    <div class="box">
                        <div class="box-img">
                            <a href="detail.php?id=<?php echo $film['id']; ?>">Detail</a>
                            <img src="assets/img/<?php echo htmlspecialchars($film['image']); ?>" width="200px" height="200px" alt="Movie Image">
                        </div>
                        <h2><?php echo htmlspecialchars($film['film']); ?></h2>
                        <h3><?php echo htmlspecialchars($film['directors']); ?></h3>
                        <span><?php echo htmlspecialchars($film['genre']); ?></span>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Tidak ada data film yang tersedia saat ini.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="heading">
            <span>Services</span>
            <h2>We have collected some good films</h2>
        </div>
        <div class="service-container">
            <div class="s-box">
                <img src="assets/img/director.png" alt="Director">
                <h3>Director</h3>
                <p>Orang yang bertugas mengarahkan sebuah film sesuai dengan manuskrip, pembuat film juga digunakan untuk merujuk pada produser film. Manuskrip skenario digunakan untuk mengontrol aspek-aspek seni dan drama. Pada masa yang sama, sutradara mengawal petugas atau pekerja teknik dan pemeran untuk memenuhi wawasan pengarahannya. Seorang sutradara juga berperan dalam membimbing kru teknisi dan para pemeran film dalam merealisasikan kreativitas yang dimilikinya.</p>
            </div>
            <div class="s-box2">
                <img src="assets/img/universal.png" alt="Universal">
                <h3>Produced By</h3>
                <p>Universal Pictures (juga dikenal sebagai Universal Studios, dan sebelumnya Universal Manufacturing Company) adalah studio film Amerika yang dimiliki oleh Comcast melalui divisi Universal Filmed Entertainment Group dari anak perusahaannya yang sepenuhnya dimiliki NBCUniversal.</p>
            </div>
            <div class="s-box">
                <img src="assets/img/usanobg.png" alt="Country">
                <h3>Country</h3>
                <p>USA adalah negara republik konstitutional federal yang terdiri dari lima puluh negara bagian dan sebuah distrik federal dan usa merupakan salah satu negara dengan industri film terbesar di dunia.</p>
            </div>
        </div>
    </section>

<?php endif; ?>

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
</body>
</html>