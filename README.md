<div id="top"></div>
<br />
<div align="center">
  <a href="https://github.com/rjp2525/stuffed-recipes">
    <img src=".github/banner_logo.png" alt="Stuffed Recipes - The Best Recipe Sharing Community" width="888" height="200">
  </a>

  <h3 align="center"><b>STUFFED RECIPES: RECIPE SHARING WEB APPLICATION</b></h3>

  <br />

[![Visit Production Site][production-shield]][production-url]
[![Issues][issues-shield]][issues-url]
[![Bugs][bug-shield]][bug-url]
[![License][license-shield]][license-url]
[![Coverage][coverage-shield]][coverage-url]
[![Release][release-shield]][release-url]
<br />

</div>

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About the Stuffed Recipe Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>

<br/>

## About The Project

[![Stuffed Recipes Screenshot][stuffed-screenshot]](https://stuffedrecipes.io)

Stuffed Recipes is a new recipe sharing site I decided to build after getting frustrated with the infinite number of advertisements and 16-page essay on the author's emotional relationship with the recipe. (No offense to anyone who enjoys writing those, sometimes they're pretty good - for those, Stuffed Recipes has a blog section and you can link to articles within the recipe).

<p align="right">(<a href="#top">back to top</a>)</p>

### Built With

We utilize a lot of great frameworks, libraries and open source packages from the community to allow the Stuffed Recipe software to operate in the fullest capacity. This section outlines the major frameworks and plugins we use behind the scenes to power it. Other packages and libraries we use can be found in the <a href="#acknowledgements">acknowledgements</a> section below.

-   [Laravel](https://laravel.com)
-   [Inertia](https://inertiajs.com)
-   [Vue.js](https://vuejs.org)
-   [TailwindCSS](https://tailwindcss.com)
-   [PostCSS](https://postcss.org)

<p align="right">(<a href="#top">back to top</a>)</p>

## Getting Started

This section provides instructions on installing and setting up the project locally in a development environment.

<br />

### Prerequisites

Prior to installing the project, you should have the following prerequisites installed:

-   [PHP](https://www.php.net) `>= 8.1` (see [new features](https://www.php.net/releases/8.1/en.php) in `8.1+` used in the software)
-   PHP Extensions
    -   [BCMath](https://www.php.net/manual/en/book.bc.php)
    -   [Ctype](https://www.php.net/manual/en/book.ctype.php)
    -   [Fileinfo](https://www.php.net/manual/en/book.fileinfo.php)
    -   [JSON](https://www.php.net/manual/en/book.json.php)
    -   [Mbstring](https://www.php.net/manual/en/book.mbstring.php)
    -   [OpenSSL](https://www.php.net/manual/en/book.openssl.php)
    -   [PDO](https://www.php.net/manual/en/ref.pdo-mysql.php)
    -   [Tokenizer](https://www.php.net/manual/en/book.tokenizer.php)
    -   [XML](https://www.php.net/manual/en/book.xml.php)
    -   [xdebug](https://xdebug.org)
-   [Composer Dependency Manager](https://getcomposer.org)
-   [Redis](https://redis.io) `>= 6.2`
-   [MariaDB](https://mariadb.org) `>= 10.6`
-   [Node.js](https://nodejs.org/en/) `>= 16.8`
-   [npm](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm) `>= 7.21`

### Installation

_This section still needs to be completed. Check back soon._

<p align="right">(<a href="#top">back to top</a>)</p>

## Roadmap

-   [ ] Homepage with latest recipes, top authors, top rated recipes, cuisine categories
-   [ ] User authentication system for more personalized feeds and authenticated features
-   [ ] Recipe "forking" - similar to GitHub, forking a recipe allows you to modify it to your liking. Unknown at this time if anything like "pull requests" will be supported to merge back into the original recipe, but is being considered
-   [ ] Review recipes through a 5-star rating system and text/image reviews
-   [ ] Allow users to upload photos of how their own rendition of the recipe came out
-   [ ] Blog section to absorb the long explanation part of the recipe, if desired. These posts will be linked at the top of a recipe but will not be intrusive to the reading experience
-   [ ] Advertisements will be strategically placed to be non intrusive for the user experience
-   [ ] Achievement badge system to encourage contributions and competitiveness within the community
-   [ ] Paid (inexpensive) personal account plan to allow for private recipes and an ad-free experience
-   [ ] Follow other users with notification settings for any new recipes they post (can be highly customized and filtered down for notifications based on specific tags, ingredients, keywords etc.)
-   [ ] Elaborate food database with ingredient and nutrition information to help with dietary needs
-   [ ] Elaborate search feature to filter recipes based on ingredients (one, a few, or even only explicit ingredients), tags, cuisine, nutrition information such as protein, carbs, fats etc, by reviews, authors and more.
-   [ ] Scalable recipe ingredients to increase serving size, each recipe can also be configured with different instructions based on the serving size in case the ingredients don't scale against cooking times or other factors

<p align="right">(<a href="#top">back to top</a>)</p>

## Contributing

Contributions are what make any software great.

Features that are developed by are to be done in a separate branch from `develop` or `master` and should follow the [contribution guidelines](.github/CONTRIBUTING.md). A pull request must be opened to merge any changes to either branch. If there is a feature idea, simply open an issue with the type tag "Type: Enhancement" and "Feature: " tag for whichever part of the application the idea is for.

1. Clone the Project
2. Create your Feature branch (`git checkout -b feature/NewFeature`)
3. Commit your changes (`git commit -m 'Added feature for users to leave comments'`)
4. Push to the branch (`git push origin feature/NewFeature`)
5. Open a pull request to the `develop` or `master` branch on this repository

<p align="right">(<a href="#top">back to top</a>)</p>

## License

This software is licensed under the GNU APLGv3 license. Please see [LICENSE.md](LICENSE.md) for more information.

<p align="right">(<a href="#top">back to top</a>)</p>

## Contact

Reno Philibert - [hello@reno.sh](mailto:hello@reno.sh)

Project Link: [https://github.com/rjp2525/stuffed-recipes](https://github.com/rjp2525/stuffed-recipes)

<p align="right">(<a href="#top">back to top</a>)</p>

## Acknowledgments

The Stuffed Recipes application uses a lot of great packages and libraries provided by the open source community to make things easier, better and cooler. Those external libraries are listed below.

### Javascript

-   [lodash](https://lodash.com) - A modern JavaScript utility library delivering modularity, performance & extras
-   [vue3-smooth-scroll](https://github.com/laineus/vue3-smooth-scroll) - Lightweight Vue plugin for smooth-scrolling

### PHP Packages

-   [reinink/remember-query-strings](https://github.com/reinink/remember-query-strings) - automatically remembers and restores query strings
-   [tightenco/ziggy](https://github.com/tighten/ziggy) - provides application routes and helpers to JavaScript

<p align="right">(<a href="#top">back to top</a>)</p>

[production-shield]: https://img.shields.io/static/v1?label=Production%20Site&message=Offline&color=red&style=for-the-badge
[production-url]: https://stuffed-recipes.io
[bug-shield]: https://img.shields.io/static/v1?label=Bugs&message=Report&color=orange&style=for-the-badge
[bug-url]: https://github.com/rjp2525/stuffed-recipes/issues/new
[issues-shield]: https://img.shields.io/static/v1?label=Issues&message=view&color=yellow&style=for-the-badge
[issues-url]: https://github.com/rjp2525/stuffed-recipes/issues
[license-shield]: https://img.shields.io/static/v1?label=License&message=GNU+AGPLv3&color=663366&style=for-the-badge
[license-url]: https://github.com/rjp2525/stuffed-recipes/blob/master/LICENSE.md
[coverage-shield]: https://img.shields.io/codecov/c/github/rjp2525/stuffed-recipes?label=test%20coverage&style=for-the-badge
[coverage-url]: https://github.com/rjp2525/stuffed-recipes/releases
[release-shield]: https://img.shields.io/github/v/release/rjp2525/stuffed-recipes?include_prereleases&style=for-the-badge
[release-url]: https://github.com/rjp2525/stuffed-recipes/releases
[stuffed-screenshot]: .github/screenshot.png
