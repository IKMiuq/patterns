FROM php:8.2-cli
COPY . /usr/src/patterns
WORKDIR /usr/src/patterns

RUN echo '#!/bin/sh\n\
if [ -z "$1" ]; then\n\
    echo "Usage: docker run <image> <filename.php>"\n\
    echo "Available PHP files:"\n\
    find /usr/src/patterns -name "*.php" -type f | sed "s|/usr/src/patterns/||"\n\
    exit 1\n\
fi\n\
\n\
# Ищем файл относительно корневой директории проекта\n\
FILE="/usr/src/patterns/$1"\n\
\n\
# Если файл не найден по относительному пути, ищем по имени\n\
if [ ! -f "$FILE" ]; then\n\
    FOUND_FILE=$(find /usr/src/patterns -name "$(basename "$1")" -type f | head -1)\n\
    if [ -n "$FOUND_FILE" ]; then\n\
        FILE="$FOUND_FILE"\n\
        echo "⚠️  File found by name: $FOUND_FILE"\n\
    else\n\
        echo "❌ Error: File $1 not found!"\n\
        echo "Available files:"\n\
        find /usr/src/patterns -name "*.php" -type f | sed "s|/usr/src/patterns/||"\n\
        exit 1\n\
    fi\n\
fi\n\
\n\
echo "✅ Running: $FILE"\n\
php "$FILE"' > /entrypoint.sh && \
    chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]