<template>
  <div>
    <section class="navigation">
      <div class="nav-container">
        <div class="brand">
          <a href="#!">Logo</a>
        </div>
        <nav>
          <div class="nav-mobile">
            <a id="navbar-toggle" href="#!"><span></span></a>
          </div>
          <ul class="nav-list">
            <li>
              <a href="#!">Home</a>
            </li>
            <li>
              <RouterLink  :to="'/about'">About</RouterLink>
            </li>
            <li>
              <a href="#!">Services</a>
              <ul class="navbar-dropdown">
                <li>
                  <a href="#!">Sass</a>
                </li>
                <li>
                  <a href="#!">Less</a>
                </li>
                <li>
                  <a href="#!">Stylus</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="#!">Portfolio</a>
            </li>
            <li>
              <a href="#!">Category</a>
              <ul class="navbar-dropdown">
                <li>
                  <a href="#!">Sass</a>
                </li>
                <li>
                  <a href="#!">Less</a>
                </li>
                <li>
                  <a href="#!">Stylus</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="#!">Contact</a>
            </li>
          </ul>
        </nav>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "ParentComponent",
};
</script>

