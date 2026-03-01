import WorkHero from "@/components/sections/work-detail/WorkHero";
import WorkIntro from "@/components/sections/work-detail/WorkIntro";
import WorkGallery from "@/components/sections/work-detail/WorkGallery";
import Footer from "@/components/layout/Footer";
import RelatedWorks from "@/components/sections/work-detail/RelatedWorks";

// Eğer "@/..." çalışmıyorsa bunları böyle yaz:
// import WorkHero from "../../../components/sections/work-detail/WorkHero";
// import WorkIntro from "../../../components/sections/work-detail/WorkIntro";
// import WorkGallery from "../../../components/sections/work-detail/WorkGallery";
// import Footer from "../../../components/layout/Footer";

export default function TurkTelekomPage() {
    return (
        <main className="bg-white">
            <WorkHero
                backgroundImage="/images/works/turk-telekom/1.jpg"
                videoSrc="/videos/turk-telekom.mp4"
            />

            <WorkIntro
                title={"Türk\nTelekom"}
                description={
                    "Atatürk Kültür Merkezi’nde yer alan,\nTürk Telekom sponsorluğunda\ngerçekleşen, Dijital Tasarım Sergisi’nin\nkarşılama bölümü için kurduğumuz bu\nprojede, ana led ekranın altından\ngirişe kadar devam eden floor ayna\nbulunmakta."
                }
                rightImage="/images/works/turk-telekom/2.jpg"
                leftVideo="/videos/turk-telekom.mp4"
                dateLabel="Ocak 2025"
                quoteText={
                    "Alana yayılmış farklı ölçülerde, farklı\nnoktalara yerleştirilen köşeli küp\nledlerimiz ile ilgi çeken, güzel bir proje\ngerçekleştirdik."
                }
            />

            <WorkGallery
                images={[
                    "/images/works/turk-telekom/1.jpg",
                    "/images/works/turk-telekom/2.jpg",
                    "/images/works/turk-telekom/3.jpg",
                    "/images/works/turk-telekom/4.jpg",
                ]}
            />

            <RelatedWorks
                items={[
                    {
                        title: "KÜLTÜR BAKANLIĞI",
                        image: "/images/works/kultur-bakanligi/hero.jpg",
                        href: "/works/kultur-bakanligi",
                        variant: "large",
                    },
                    {
                        title: "BINGHATTI",
                        image: "/images/works/binghatti/hero.jpg",
                        href: "/works/binghatti",
                        variant: "small",
                    },
                    {
                        title: "TÜRK TELEKOM",
                        image: "/images/works/turk-telekom/1.jpg",
                        href: "/works/turk-telekom",
                        variant: "tall",
                    },
                ]}
            />
            /

            <Footer />
        </main>
    );
}