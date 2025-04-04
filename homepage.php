<!-- index.html -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Indian Cultural Sites</title>
    <link rel="stylesheet" href="homepage.css" />
  </head>
  <body>
    <header>
      <?php include 'header.php'; ?>
    </header>

    <div class="video-section">
      <video autoplay muted loop class="background-video">
        <source
          src="./assets/videos/Welcome to India ! [CINEMATIC TRAVEL FILM]_Full-HD.mp4"
          type="video/mp4"
        />
      </video>
      <div class="overlay">
        <div class="slogan-slider">
          <span id="slogan-text">Celebrating India's Rich Culture</span>
        </div>
        <a href="#cultural-sites" id="view-more" class="view-more">View More</a>
      </div>
      <script>
        document.addEventListener("DOMContentLoaded", function () {
          // Array of slogans
          const slogans = [
            "Celebrating India's Rich Culture",
            "Diversity in Every Corner",
            "Experience Timeless Traditions",
            "India: Where Culture Thrives",
            "Discover the Heart of Heritage",
          ];

          let sloganIndex = 0;
          let charIndex = 0;
          const typingSpeed = 100; // Speed of typing (milliseconds)
          const pauseBetweenSlogans = 2000; // Pause between slogans (milliseconds)
          const sloganText = document.getElementById("slogan-text");

          function typeSlogan() {
            // Get the current slogan
            const currentSlogan = slogans[sloganIndex];

            // Display the next character
            if (charIndex < currentSlogan.length) {
              sloganText.textContent += currentSlogan.charAt(charIndex);
              charIndex++;
              setTimeout(typeSlogan, typingSpeed);
            } else {
              // Pause after finishing the slogan, then proceed to the next one
              setTimeout(() => {
                // Reset text and move to the next slogan
                sloganText.textContent = "";
                charIndex = 0;
                sloganIndex = (sloganIndex + 1) % slogans.length;
                typeSlogan();
              }, pauseBetweenSlogans);
            }
          }

          // Start the typewriter effect when the page loads
          typeSlogan();
          document
            .getElementById("view-more")
            .addEventListener("click", function (event) {
              event.preventDefault(); // Prevent default anchor behavior

              const target = document.querySelector("#cultural-sites");
              const headerOffset = 100; // Adjust offset based on header height
              const elementPosition =
                target.getBoundingClientRect().top + window.pageYOffset;
              const offsetPosition = elementPosition - headerOffset;

              window.scrollTo({
                top: offsetPosition,
                behavior: "smooth",
              });
            });
        });
      </script>
    </div>

    <div class="bigcontainer">
      <div class="map-container">
        <div class="map-text">
          <h2>Indian Map with Marked Cultural Sites</h2>
          <br />
          <p>Click on the marker of the states</p>
          <p>to know more about that state</p>
        </div>
        <!-- The image with the usemap attribute -->
        <img src="assets/map/map.jpg" alt="Map of India" usemap="#india-map" />

        <!-- Image map with clickable areas -->
        <map name="india-map">
          <!-- Define an area for each point on the map, matching original image size -->
          <area
            shape="circle"
            coords="84,289,20"
            href="state.php?id=ST113"
            alt="Gujarat"
          />
          <area
            shape="circle"
            coords="173,295,20"
            href="state.php?id=ST119"
            alt="MP"
          />
          <area
            shape="circle"
            coords="238,221,20"
            href="state.php?id=ST126"
            alt="UP"
          />
          <area
            shape="circle"
            coords="129,81,20"
            href="state.php?id=ST101"
            alt="Jammu"
          />
          <area
            shape="circle"
            coords="146,439,20"
            href="state.php?id=ST117"
            alt="Karnataka"
          />
          <area
            shape="circle"
            coords="437,226,20"
            href="state.php?id=ST103"
            alt="Assam"
          />
          <!-- Add more areas as needed -->
        </map>
      </div>
      <section class="cultural-sites" id="cultural-sites">
        <h3>Cultural Sites</h3>
        <div class="sites-grid">
          <!-- Adding uploaded images here -->
          <div class="site-item">
            <img src="./assets/cultural_sites/Uttar Pradesh/Taj_Mahal.jpg" alt="Taj Mahal" />
            <p class="hover-text" style="display: none;">Taj Mahal</p>
          </div>
          <div class="site-item">
            <img src="./assets/cultural_sites/Karnataka/somanathapura_vishnu_temple.jpg" alt="" />
            <p class="hover-text" style="display: none;">Somanathapura Vishnu Temple</p>
          </div>
          <div class="site-item">
            <img src="./assets/cultural_sites/Gujarat/The-Statue-of-Unity.jpg" alt="" />
            <p class="hover-text" style="display: none;">The Statue of Unity</p>
          </div>
        </div>
      </section>

      <section class="artist-products">
        <h3>Local Artist Products</h3>
        <div class="products-grid">
          <div class="product-item">
            <img src="./assets/products/Uttar Pradesh/Silh_Handloom_Banarasi_Saree.jpg" alt="" />
            <p class="hover-text" style="display: none;">Handloom Banarasi Saree</p>
          </div>
          <div class="product-item">
            <img src="./assets/products/Karnataka/Channapatna_Toys.jpg" alt="" />
            <p class="hover-text" style="display: none;">Channapatna Toys</p>
          </div>
          <div class="product-item">
            <img src="./assets/products/Assam/ThangkaPaintings.jpg" alt="" />
            <p class="hover-text" style="display: none;">Thangka Paintings</p>
          </div>
          <div class="product-item">
            <img src="./assets/products/Karnataka/Rosewood_decorative.jpg" alt="" />
            <p class="hover-text" style="display: none;">Rosewood Decorative</p>
          </div>
        </div>
        
      </section>
      <script>
        document.querySelectorAll('.product-item').forEach(item => {
          item.addEventListener('mouseover', () => {
            item.querySelector('.hover-text').style.display = 'block';
          });
          item.addEventListener('mouseout', () => {
            item.querySelector('.hover-text').style.display = 'none';
          });
        });
      </script>
      <script>
        document.querySelectorAll('.site-item').forEach(item => {
          item.addEventListener('mouseover', () => {
            item.querySelector('.hover-text').style.display = 'block';
          });
          item.addEventListener('mouseout', () => {
            item.querySelector('.hover-text').style.display = 'none';
          });
        });
      </script>
    </div>

    <footer>
      <!-- <iframe
        src="footer.html"
        width="100%"
        height="auto"
        frameborder="0"
        style="height: 400px"
      ></iframe> -->
      <?php include 'footer.php'; ?>
    </footer>
  </body>
</html>