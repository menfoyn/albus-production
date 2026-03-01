import Hero from "@/components/works/binghatti/Hero";
import Intro from "@/components/works/binghatti/Intro";
import Gallery from "@/components/works/binghatti/Gallery";
import Footer from "@/components/layout/Footer";

export default function BinghattiPage() {
    return (
        <main className="bg-white">
            <Hero
                backgroundImage="/images/works/binghatti/hero.jpg"
                // Şimdilik Turk Telekom videosu (editlenince değiştiririz)
                videoSrc="/videos/turk-telekom.mp4"
            />

            <Intro
                title={"Binghatti"}
                description={
                    "Rixos Tersane’de gerçekleştirilen\nBinghatti İnşaat Şirketi'nin lansman\nprojesini gerçekleştirdik.\n\nLansman ve karşılama alanının farklı\nled kurulumları ile ele aldığımız bu\nprojede giriş alanı boyunca\nsütunlardan oluşan tüneller\nyerleştirdik."}
                
                rightImage="/images/works/binghatti/right-1.jpg"
                leftVideo="/videos/turk-telekom.mp4"
                dateLabel="Ağustos 2025"
                quoteText={
                    "İçeride yine farklı noktalara\nyerleştirilmiş indoor ledlerimizle iyi bir\ngörüntü kalitesi deneyimi yaşattık"
                }
            />

            {/* wide-1 + galeri görselleri */}
            <Gallery
                images={[
                    "/images/works/binghatti/wide-1.jpg",
                    "/images/works/binghatti/gallery-1.jpg",
                    "/images/works/binghatti/gallery-2.jpg",
                    "/images/works/binghatti/gallery-3.jpg",
                    "/images/works/binghatti/gallery-4.jpg",
                ]}
            />

            <Footer />
        </main>
    );
}