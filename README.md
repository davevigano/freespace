# freespace

A simple, free and lightweight social network.

No moderation, no accounts: just pure fun!

Post something, tag it, like or dislike other people's posts, and leave comments — all anonymous, all disposable.

**Live demo:** [web-production-8d26a.up.railway.app](https://web-production-8d26a.up.railway.app)

## Features

- Text posts with title, content and comma-separated tags
- Likes / dislikes per post
- Comments per post, with a live count on the feed
- Light/dark mode toggle

## Tech stack

- PHP (`mysqli`, prepared statements) served via its built-in dev server
- MySQL 8
- Vanilla JS + jQuery + Bootstrap 5.1.3 on the frontend
- Everything runs in Docker, no local PHP/MySQL install required

## Getting started

Requires [Docker Desktop](https://www.docker.com/products/docker-desktop/).

```bash
git clone https://github.com/davevigano/freespace.git
cd freespace
docker compose up -d
```

Then open [http://localhost:8080](http://localhost:8080).

The `db` container is initialized automatically from [`schema.sql`](schema.sql) (table structure) and [`seed.sql`](seed.sql) (a handful of sample posts and comments), so there's data to look at right away.

To stop everything:

```bash
docker compose down
```

Add `-v` to also drop the database volume and start fresh next time.

## Project structure

| File | Purpose |
| --- | --- |
| `index.php` | Renders the feed |
| `functions.php` | Handles the AJAX actions (new post, like/dislike, comments) |
| `db.php` | Database connection; reads host/user/password/db/port from env vars (`MYSQLHOST`, `MYSQLUSER`, `MYSQLPASSWORD`, `MYSQLDATABASE`, `MYSQLPORT`), falling back to the `docker-compose.yml` defaults |
| `schema.sql` | `post` / `comment` table definitions |
| `seed.sql` | Sample data loaded on first container start |
| `docker-compose.yml` / `Dockerfile` | Local dev environment and deploy image (PHP and MySQL containers) |

## Deployment

The live demo runs on [Railway](https://railway.app) (free tier): a `web` service built straight from the `Dockerfile`, and a `MySQL` service, connected via Railway's private network. `db.php` picks up `MYSQLHOST`/`MYSQLUSER`/`MYSQLPASSWORD`/`MYSQLDATABASE`/`MYSQLPORT` automatically from the environment Railway injects.

To redeploy after pulling changes:

```bash
railway up --service web
```

`schema.sql` / `seed.sql` are only auto-applied by the local `docker-compose.yml` setup — on Railway they were loaded once by hand via `railway connect MySQL --tunnel-only`.

## Known limitations

This project prioritizes simplicity over hardening — it has no accounts and no moderation by design.

- There's no rate limiting or spam protection.

## License

MIT — see [LICENSE](LICENSE).
