# PrivateBin LazyCat community package

Upstream https://github.com/PrivateBin/PrivateBin (Zlib/libpng), 2.1.0. Package `community.lazycat.app.privatebin`, min OS 1.6.0, amd64, mirror delivery, community (喵喵) store only. The official `cloud.lazycat.app.privatebin` entry is a separate build.

Single PHP-FPM + nginx container, no database. Pastes are stored as ciphertext on the filesystem in one bind:

    /lzcapp/var/data:/srv/data

The image ships `/srv` as application code and only `/srv/data` as a volume, so `content/start.sh` copies the packaged `conf.php` into `/srv/cfg/conf.php` before executing the unmodified upstream entrypoint. Only the paste store is bound — no other image paths are shadowed.

Configuration keeps upstream's defaults and adds only what a single-container deployment needs: filesystem storage under the data volume, 10 MB paste cap, per-creation rate limit, zh/en UI. No account system is added, because PrivateBin's whole point is share-by-link: whoever holds the link can read the paste, and the server never holds the decryption key (it lives after the `#` in the URL).

Not device-tested: paste creation, expiry cleanup, burn-after-reading, browser-side encrypt/decrypt, and persistence across restarts.
