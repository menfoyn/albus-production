import Navbar from "@/components/layout/Navbar";
import Footer from "@/components/layout/Footer";

import Hero from "@/components/sections/Hero";
import Services from "@/components/sections/Services";
import Work from "@/components/sections/Work";
import About from "@/components/sections/About";
import Contact from "@/components/sections/Contact";

export default function Home() {
    return (
        <>
            <Navbar />

            <main>
                <Hero />
                <Work />
                <Services />
                
                
            </main>

            <Footer />
        </>
    );
}