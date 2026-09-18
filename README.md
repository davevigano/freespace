# freespace

A simple, free and lightweight social network.

No moderation, no accounts: just pure fun!

Post something, tag it, like or dislike other people's posts, and leave comments — all anonymous, all disposable.

## Features

- Text posts with title, content and comma-separated tags
- Likes / dislikes per post
- Comments per post, with a live count on the feed
- Light/dark mode toggle

## Tech stack

- PHP (`mysqli`, prepared statements) served by Apache
- MySQL 8
- Vanilla JS + jQuery + Bootstrap 5.1.3 on the frontend
- Everything runs in Docker, no local PHP/MySQL install required

## Getting started

Requires [Docker Desktop](https://www.docker.com/products/docker-desktop/).

```bash
git clone https://github.com/davevigano/freespace.git
cd freespace
cp db.example.php db.php
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
| `db.php` | Database connection (gitignored — copy it from `db.example.php`) |
| `schema.sql` | `post` / `comment` table definitions |
| `seed.sql` | Sample data loaded on first container start |
| `docker-compose.yml` / `Dockerfile` | Local dev environment (PHP+Apache and MySQL containers) |

## Known limitations

This project prioritizes simplicity over hardening — it has no accounts and no moderation by design. A couple of things worth knowing if you plan to run it anywhere but your own machine:

- Post/comment content is rendered without HTML-escaping, so it's vulnerable to stored XSS.
- There's no rate limiting or spam protection.

## License

MIT — see [LICENSE](LICENSE).
