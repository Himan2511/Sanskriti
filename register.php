<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="stylesheet" href="register.css" />
    <style>
      /* Modal Background Styling */
      .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
      }

      /* Modal Content Styling */
      .modal-content {
        background-color: #ffffff;
        padding: 25px;
        border-radius: 10px;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        text-align: center;
      }

      /* Close Button Styling */
      .close {
        color: #333;
        float: right;
        font-size: 22px;
        font-weight: bold;
        cursor: pointer;
        margin-top: -5px;
      }
      .close:hover {
        color: #888;
      }

      /* Input and Button Styling */
      #gstin {
        width: 100%;
        padding: 10px;
        margin-top: 15px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
      }
      #submitGstin {
        background-color: #007bff;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
      }
      #submitGstin:hover {
        background-color: #0056b3;
      }
    </style>
  </head>
  <body>
    <header>
      <?php include 'header.php'; ?>
    </header>

    <main class="container">
      <h2>Register</h2>

      <div class="form-container">
        <form id="registrationForm" action="register_action.php" method="POST">
          <label for="name">Name: </label>
          <input
            type="text"
            id="name"
            name="name"
            placeholder="Enter your name"
            required
          />

          <label for="UserID">User ID: </label>
          <input
            type="text"
            id="UserID"
            name="UserID"
            placeholder="Enter User ID"
            required
          />

          <label for="pass">Password: </label>
          <input
            type="password"
            id="pass"
            name="pass"
            placeholder="Enter Password"
            required
          />

          <label for="phone">Phone No: </label>
          <input
            type="text"
            id="phone"
            name="phone"
            placeholder="Enter phone number"
            required
          />

          <label for="email">Email ID: </label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="Enter Email ID"
            required
          />

          <h4 id="address">Address</h4>

          <label for="street">Street: </label>
          <input
            type="text"
            id="street"
            name="street"
            placeholder="Enter street"
          />

          <label for="city">City: </label>
          <input type="text" id="city" name="city" placeholder="Enter city" />

          <label for="state">State: </label>
          <input
            type="text"
            id="state"
            name="state"
            placeholder="Enter state"
          />

          <label for="pincode">Pincode: </label>
          <input
            type="text"
            id="pincode"
            name="pincode"
            placeholder="Enter pincode"
          />

          <div id="save">
            <button type="submit" class="submit-button" id="customerButton">
              Register as Customer
            </button>
            <button type="button" class="submit-button" id="retailerButton">
              Register as Retailer
            </button>
          </div>
        </form>
      </div>
    </main>

    <!-- Modal for GSTIN -->
    <div id="gstinModal" class="modal">
      <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h3>Enter GSTIN Number</h3>
        <input
          type="text"
          id="gstin"
          name="gstin"
          placeholder="Enter GSTIN"
          required
        />
        <button type="button" id="submitGstin">Submit</button>
      </div>
    </div>

    <footer>
      <?php include 'footer.php'; ?>
    </footer>

    <script>
      // Get elements
      const retailerButton = document.getElementById("retailerButton");
      const gstinModal = document.getElementById("gstinModal");
      const closeModal = document.getElementById("closeModal");
      const submitGstin = document.getElementById("submitGstin"); // Ensure modal is hidden by default

      gstinModal.style.display = "none"; // Show modal when retailer button is clicked

      retailerButton.addEventListener("click", () => {
        gstinModal.style.display = "flex";
      }); // Close modal

      closeModal.addEventListener("click", () => {
        gstinModal.style.display = "none";
      }); // Submit GSTIN and hide modal

      submitGstin.addEventListener("click", () => {
        const gstin = document.getElementById("gstin").value;

        if (gstin.trim() === "") {
          alert("Please enter GSTIN number.");
        } else {
          // If GSTIN is entered, add it to a hidden field in the form
          let hiddenField = document.createElement("input");
          hiddenField.setAttribute("type", "hidden");
          hiddenField.setAttribute("name", "gstin");
          hiddenField.setAttribute("value", gstin);
          document.getElementById("registrationForm").appendChild(hiddenField);

          gstinModal.style.display = "none"; // Hide modal
          document.getElementById("registrationForm").submit(); // Submit form
        }
      }); // Close modal when clicking outside the modal content

      window.addEventListener("click", (event) => {
        if (event.target === gstinModal) {
          gstinModal.style.display = "none";
        }
      });
    </script>
  </body>
</html>
