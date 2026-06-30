# V29 Theme

A WordPress CMS project for the V29 architectural collective. Built on a custom Timber/Twig theme with Secure Custom Fields. DDEV handles the local environment.

## Prerequisites

- [DDEV](https://ddev.readthedocs.io/en/stable/) installed on your machine
- Docker installed and running

## Setup

1. Clone the repository:

    ```sh
    git clone git@github.com:dideldumthecat/v29-org.git
    cd v29-org
    ```

2. Copy the env file and fill in the values (DDEV handles DB credentials automatically):

    ```sh
    cp .env.example .env
    ```

3. Start the DDEV environment:

    ```sh
    ddev start
    ```

4. Install WordPress, plugins, and activate the theme:

    ```sh
    ddev exec bash install.sh
    ```

5. Import the database dump:

    ```sh
    ddev import-db --src=v29.sql.gz
    ```

6. Open the site:

    ```sh
    ddev launch
    ```

    The local dev site runs at `https://v29.ddev.site/`.