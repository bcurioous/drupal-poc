import { serve } from "bun";

const PORT = parseInt(Bun.env.PORT || "3000");
const STATIC_DIR = Bun.env.STATIC_DIR || ".";

console.log(`Starting server on http://localhost:${PORT}`);
console.log(`Serving static files from: ${STATIC_DIR}`);

serve({
  port: PORT,
  async fetch(req) {
    const url = new URL(req.url);
    let path = url.pathname;

    if (path === "/") {
      path = "/index.html";
    }

    const filePath = `${STATIC_DIR}${path}`;
    const file = Bun.file(filePath);

    if (await file.exists()) {
      return new Response(file, {
        headers: {
          "Content-Type": getContentType(filePath),
        },
      });
    }

    return new Response("Not Found", { status: 404 });
  },
});

function getContentType(path: string): string {
  const ext = path.split(".").pop()?.toLowerCase();
  switch (ext) {
    case "html":
      return "text/html; charset=utf-8";
    case "css":
      return "text/css";
    case "js":
      return "application/javascript";
    case "json":
      return "application/json";
    case "png":
      return "image/png";
    case "jpg":
    case "jpeg":
      return "image/jpeg";
    case "svg":
      return "image/svg+xml";
    case "ico":
      return "image/x-icon";
    case "woff":
      return "font/woff";
    case "woff2":
      return "font/woff2";
    case "ttf":
      return "font/ttf";
    case "eot":
      return "application/vnd.ms-fontobject";
    default:
      return "application/octet-stream";
  }
}
