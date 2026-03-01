import HeaderBar from "@/components/layout/HeaderBar";
import Footer from "@/components/layout/Footer";
import WorksTabs from "@/components/sections/works/WorksTabs";
import WorksGrid from "@/components/sections/works/WorksGrid";

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