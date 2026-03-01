"use client";
import dynamic from "next/dynamic";

import HeaderBar from "@/components/layout/HeaderBar";
import Footer from "@/components/layout/Footer";

// NOTE: /works page was failing during prerender/static export because one (or both)
// of these components uses browser-only APIs (window/document) during render.
// We render them on the client only to prevent build-time/prerender crashes.
const WorksTabs = dynamic(() => import("@/components/sections/works/WorksTabs"), {
  ssr: false,
});
const WorksGrid = dynamic(() => import("@/components/sections/works/WorksGrid"), {
  ssr: false,
});

export default function WorksPage() {
  return (
    <main className="bg-white">
      {/* ÜST MOR BAR (Header) */}
      <HeaderBar />

      {/* KATEGORİ TABLARI */}
      <WorksTabs />

      {/* GRID */}
      <WorksGrid />

      <Footer />
    </main>
  );
}