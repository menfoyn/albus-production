export default function Contact() {
    return (
        <section id="contact" className="px-4 py-20">
            <div className="mx-auto max-w-6xl text-center">
                <h2 className="text-2xl font-semibold tracking-tight">
                    Let’s work together
                </h2>

                <p className="mt-4 text-base opacity-80">
                    Have a project in mind? Let’s talk.
                </p>

                <a
                    href="mailto:info@albusproduction.com"
                    className="mt-8 inline-block rounded-xl bg-black px-6 py-3 text-sm text-white"
                >
                    Contact Us
                </a>
            </div>
        </section>
    );
}