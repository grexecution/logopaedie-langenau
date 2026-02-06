# Logopädie Langenau - Design System Standards

## Important: CSS File Usage
**Always use `style.css` for all styling.** Do NOT add styles to `additional.css`. The `style.css` file is the single source of truth for all theme styles.

- `style.css` - Main design system, custom page styles
- `additional.css` - WordPress default components only (posts, comments, widgets, search, 404)

## Page Structure
- `/` (root) - Landing page (`front-page.php`)
- `/jobausschreibung/` - Job posting page (`page-jobausschreibung.php`)

Both pages share the same `header.php` and `footer.php`.

## Layout Standards

### Max-Width
- **Container max-width: 1200px** - This applies to ALL content sections
- Navbar content: 1200px max-width, centered
- Regular content sections: 1200px max-width, centered
- Footer content: 1200px max-width, centered
- Full-width backgrounds are allowed, but inner content must respect 1200px

### Spacing
- Section padding: 80px vertical (desktop), 48px vertical (mobile)
- Container horizontal padding: 24px (mobile), 80px (tablet+)
- Card gaps: 32px
- Element spacing: 16px, 24px, 32px, 48px

## Color System

### Primary Colors
- **Primary Orange**: `#ff6b4e` - Main CTA, buttons, accents
- **Dark Blue**: `#002844` - Headers, text, footer background
- **White**: `#ffffff` - Backgrounds, button text

### Secondary Colors
- **Gray 50**: `#f9fafb` - Section backgrounds
- **Gray 300**: `#d1d5db` - Footer text, borders
- **Gray 400**: `#9ca3af` - Secondary text
- **Gray 600**: `#4b5563` - Body text
- **Gray 700**: `#374151` - Footer border

### Gradients
- Hero background: Orange diagonal gradient
- Button gradient: `linear-gradient(to right, #ff6b4e, #ea590d)`

## Typography

### Font Families
- **Headings**: 'Poppins', sans-serif (weights: 400, 600, 700)
- **Body**: 'PT Sans', sans-serif (weights: 400, 700)

### Font Sizes
- Hero title: 48px, line-height 60px
- Section title: 36px, line-height 40px
- Card title: 24px, line-height 32px
- Subtitle: 20px, line-height 28px
- Body text: 16px, line-height 24px
- Small text: 14px, line-height 20px

## Components

### Buttons
- Primary: White background, orange text, 8px border-radius
- Secondary: Transparent, white border, white text
- Gradient: Orange gradient background, white text
- Padding: 18px 27px
- Font: Poppins SemiBold, 16px

### Cards
- Background: White
- Border-radius: 16px
- Padding: 32px
- Shadow: subtle or none

### Icons
- Emoji style in circles
- Circle background: Gray 50
- Border-radius: 12px
- Size: 48px

## Header
- Height: 80px
- Background: White
- Logo on left
- Navigation links + CTA button on right
- CTA button: Orange background (#ff6b4e), white text, 8px radius

## Footer
- Background: #002844 (Dark Blue)
- Three columns: Company info, Contact, Opening hours
- Social icons row
- Copyright with border-top
- Text colors: White (titles), Gray 300 (body)

## Responsive Breakpoints
- Mobile: < 768px
- Tablet: 768px - 1024px
- Desktop: > 1024px

## Image Assets Location
- Logo: `/assets/images/logo.png`
- Hero image: `/assets/images/hero-team.png`
- Map image: `/assets/images/map-langenau.png`
- Icons: Use inline SVGs or emoji

## Section Order (Front Page)
1. Header (fixed)
2. Hero section with job posting
3. Three info cards (Aufgaben, Alltag, Mitbringen)
4. Map + Fahrzeiten section
5. WhatsApp CTA section
6. Philosophy section
7. Footer
