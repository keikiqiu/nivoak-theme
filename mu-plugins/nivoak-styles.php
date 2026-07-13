<?php
/**
 * Nivoak Additional Styles - Mu-Plugin
 * Adds CSS for archive pages, blog listing, single posts, and contact form.
 */

add_action('wp_head', function() {
    echo '<style>
    /* ===== ARCHIVE / BLOG LISTING ===== */
    .archive-content-section { padding: 60px 48px 100px; }
    .archive-content-inner { max-width: 1200px; margin: 0 auto; }

    /* Blog filter bar */
    .blog-filter-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 48px;
        padding-bottom: 24px;
        border-bottom: 1px solid var(--line);
    }
    .blog-filter-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 18px;
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 24px;
        color: var(--fg-dim);
        font-size: 12px;
        font-weight: 400;
        letter-spacing: 0.05em;
        transition: all 0.3s;
    }
    .blog-filter-btn:hover,
    .blog-filter-btn.active {
        background: var(--accent);
        color: var(--bg);
        border-color: var(--accent);
    }
    .blog-filter-count {
        font-size: 10px;
        opacity: 0.7;
        background: rgba(255,255,255,0.1);
        padding: 1px 6px;
        border-radius: 10px;
    }

    /* Article grid */
    .article-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }
    .article-card {
        display: flex;
        flex-direction: column;
        background: var(--surface);
        border: 1px solid var(--line);
        overflow: hidden;
        transition: transform 0.4s, border-color 0.3s;
    }
    .article-card:hover {
        transform: translateY(-4px);
        border-color: var(--accent-dim);
    }
    .article-image {
        aspect-ratio: 16 / 10;
        background: var(--surface-2);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }
    .article-image svg {
        width: 48px;
        height: 48px;
        color: var(--accent);
        opacity: 0.3;
        transition: opacity 0.4s, transform 0.6s;
    }
    .article-card:hover .article-image svg {
        opacity: 0.5;
        transform: scale(1.1);
    }
    .article-card .article-meta,
    .article-card .article-title,
    .article-card .article-excerpt,
    .article-card .article-read-more {
        padding-left: 24px;
        padding-right: 24px;
    }
    .article-card .article-meta { padding-top: 24px; }
    .article-card .article-read-more { padding-bottom: 24px; margin-top: auto; }
    .article-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }
    .article-category {
        font-size: 10px;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--accent);
    }
    .article-date {
        font-size: 11px;
        color: var(--fg-mute);
    }
    .article-title {
        font-family: var(--serif);
        font-size: 18px;
        font-weight: 600;
        line-height: 1.3;
        color: var(--fg);
        margin-bottom: 10px;
        transition: color 0.3s;
    }
    .article-card:hover .article-title {
        color: var(--accent-glow);
    }
    .article-excerpt {
        font-size: 13px;
        color: var(--fg-dim);
        line-height: 1.6;
        margin-bottom: 16px;
        flex: 1;
    }
    .article-read-more {
        font-size: 11px;
        font-weight: 500;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--fg);
        transition: color 0.3s, gap 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .article-card:hover .article-read-more {
        color: var(--accent);
        gap: 10px;
    }

    /* Pagination */
    .archive-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        margin-top: 60px;
    }
    .archive-pagination a,
    .archive-pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 12px;
        border: 1px solid var(--line);
        border-radius: 6px;
        font-size: 13px;
        color: var(--fg-dim);
        transition: all 0.3s;
        text-decoration: none;
    }
    .archive-pagination a:hover {
        border-color: var(--accent);
        color: var(--accent);
    }
    .archive-pagination .current {
        background: var(--accent);
        color: var(--bg);
        border-color: var(--accent);
        font-weight: 600;
    }

    /* ===== SINGLE POST ===== */
    .single-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 16px;
        font-size: 13px;
        color: var(--fg-mute);
    }
    .single-meta-dot { opacity: 0.5; }
    .single-content-inner {
        max-width: 800px;
        margin: 0 auto;
        font-size: 16px;
        line-height: 1.8;
        color: var(--fg-dim);
    }
    .single-content-inner h2 { font-family: var(--serif); color: var(--fg); margin: 1.8em 0 0.6em; font-size: 1.6em; }
    .single-content-inner h3 { font-family: var(--serif); color: var(--fg); margin: 1.4em 0 0.5em; font-size: 1.3em; }
    .single-content-inner h4 { color: var(--fg); margin: 1.2em 0 0.4em; font-size: 1.1em; }
    .single-content-inner p { margin-bottom: 1.3em; }
    .single-content-inner a { color: var(--accent); text-decoration: underline; text-decoration-color: var(--accent-dim); }
    .single-content-inner a:hover { text-decoration-color: var(--accent); }
    .single-content-inner ul, .single-content-inner ol { margin: 1em 0; padding-left: 1.5em; }
    .single-content-inner li { margin-bottom: 0.5em; }
    .single-content-inner blockquote {
        border-left: 3px solid var(--accent);
        padding: 16px 24px;
        margin: 1.5em 0;
        background: var(--surface);
        font-style: italic;
        color: var(--fg);
    }
    .single-content-inner img { max-width: 100%; height: auto; border-radius: 4px; margin: 1.5em 0; }
    .single-content-inner table { width: 100%; border-collapse: collapse; margin: 1.5em 0; }
    .single-content-inner th, .single-content-inner td {
        padding: 12px 16px;
        border: 1px solid var(--line);
        text-align: left;
    }
    .single-content-inner th { background: var(--surface); color: var(--fg); font-weight: 600; }

    /* Tags */
    .single-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 40px;
        padding-top: 24px;
        border-top: 1px solid var(--line);
    }
    .single-tag {
        display: inline-block;
        padding: 6px 14px;
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 20px;
        font-size: 11px;
        color: var(--fg-dim);
        transition: all 0.3s;
    }
    .single-tag:hover {
        border-color: var(--accent);
        color: var(--accent);
    }

    /* Post navigation */
    .single-nav {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-top: 40px;
        padding-top: 32px;
        border-top: 1px solid var(--line);
    }
    .single-nav-link {
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding: 20px;
        background: var(--surface);
        border: 1px solid var(--line);
        transition: border-color 0.3s;
    }
    .single-nav-link:hover { border-color: var(--accent-dim); }
    .single-nav-next { text-align: right; }
    .single-nav-label { font-size: 11px; color: var(--fg-mute); letter-spacing: 0.1em; text-transform: uppercase; }
    .single-nav-title { font-family: var(--serif); font-size: 14px; color: var(--fg); line-height: 1.4; }

    /* ===== CONTACT FORM ===== */
    .contact-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        max-width: 1200px;
        margin: 0 auto;
    }
    .contact-info-side { font-size: 16px; line-height: 1.8; color: var(--fg-dim); }
    .contact-info-side h2 { font-family: var(--serif); color: var(--fg); margin: 1.5em 0 0.5em; }
    .contact-info-side h3 { font-family: var(--serif); color: var(--fg); margin: 1.2em 0 0.4em; }
    .contact-info-side p { margin-bottom: 1.2em; }
    .contact-info-side a { color: var(--accent); }

    .nivoak-contact-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
        background: var(--surface);
        padding: 36px;
        border: 1px solid var(--line);
        border-radius: 4px;
    }
    .form-field { display: flex; flex-direction: column; gap: 8px; }
    .form-field label {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--fg-dim);
    }
    .form-field input,
    .form-field textarea {
        background: var(--bg-2);
        border: 1px solid var(--line);
        color: var(--fg);
        padding: 14px 16px;
        font-size: 14px;
        font-family: var(--sans);
        outline: none;
        transition: border-color 0.3s;
        border-radius: 4px;
    }
    .form-field input:focus,
    .form-field textarea:focus {
        border-color: var(--accent);
    }
    .form-field textarea { resize: vertical; min-height: 120px; }
    .contact-submit-btn {
        margin-top: 8px;
        cursor: pointer;
        border: none;
        width: fit-content;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 900px) {
        .article-grid { grid-template-columns: repeat(2, 1fr); }
        .contact-layout { grid-template-columns: 1fr; gap: 40px; }
        .single-nav { grid-template-columns: 1fr; }
    }
    @media (max-width: 768px) {
        .article-grid { grid-template-columns: 1fr; }
        .archive-content-section { padding: 40px 20px 60px; }
        .nivoak-contact-form { padding: 24px; }
    }
    </style>' . "\n";
}, 20);
