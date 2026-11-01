#!/bin/sh
# Place the packaged configuration where PrivateBin looks for it, then hand
# over to the unmodified upstream entrypoint.
#
# The image ships /srv as read-only application code and only declares
# /srv/data as a volume, so the config is copied into /srv/cfg at start. This
# wrapper adds no health probing or startup gate.
set -eu

CONF_TARGET=/srv/cfg/conf.php

mkdir -p /srv/cfg /srv/data
cp /lzcapp/pkg/content/conf.php "$CONF_TARGET"
chmod 644 "$CONF_TARGET"

# The image runs as 65534:82; keep the paste store writable for that identity.
chown -R 65534:82 /srv/data 2>/dev/null || true

exec /etc/init.d/rc.local
