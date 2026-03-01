import HeaderBar from "@/components/layout/HeaderBar";
import AboutIntro from "@/components/sections/about/AboutIntro";
import AboutMissionVision from "@/components/sections/about/AboutMissionVision";
import AboutTeam from "@/components/sections/about/AboutTeam";
import Footer from "@/components/layout/Footer";
import RelatedWorks from "@/components/sections/work-detail/RelatedWorks";


export default function AboutPage() {
    return (
        <main className="bg-white">
            <HeaderBar active="about" />

            <AboutIntro />
            <AboutMissionVision />
            <AboutTeam />
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