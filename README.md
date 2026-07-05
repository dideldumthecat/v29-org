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

## Sync from live

`ddev sync` mirrors the live site into the local environment: it imports the live database, rewrites the site URL to the local one, and mirrors `wp-content/uploads`.

Prerequisites:

- An SSH key authorized on the live server, with a host alias in your `~/.ssh/config`
- `SYNC_SSH_HOST` and `SYNC_REMOTE_PATH` set in `.env` (see `.env.example`)

```sh
ddev sync               # full mirror: database + uploads
ddev sync --skip-files  # database only
ddev sync --skip-db     # uploads only
```

The command snapshots the local database first; roll back with `ddev snapshot restore <snapshot-name>` (the name is printed on completion). After the sync, the local admin login is reset to the `INSTALL_ADMIN_*` credentials from `.env`.
