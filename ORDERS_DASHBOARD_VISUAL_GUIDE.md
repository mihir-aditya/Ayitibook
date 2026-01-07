# 📐 Professional Orders Dashboard - Visual Layout Guide

## Orders Listing Page Layout

```
┌─────────────────────────────────────────────────────────────────┐
│  📦 Orders Management                  [Print] [Export] [New Order]│
│  Manage and track all customer orders                            │
└─────────────────────────────────────────────────────────────────┘

┌──────────────┐ ┌──────────────┐ ┌──────────────┐ ┌──────────────┐
│ 📊 Total     │ │ 💰 Revenue   │ │ 📈 Average   │ │ ⏳ Pending    │
│ Orders       │ │ Rs. 45,000   │ │ Rs. 15,000   │ │ Orders       │
│ 3            │ │              │ │              │ │ 1            │
└──────────────┘ └──────────────┘ └──────────────┘ └──────────────┘

┌─────────────────────────────────────────────────────────────────┐
│ Search [         ] Status [▼] Date [       ] Sort [▼]          │
│ [Apply Filters] [Reset]                                        │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│ Order ID │ Customer        │ Amount  │ Payment│ Status    │ Date │
├─────────────────────────────────────────────────────────────────┤
│ #100001  │ [👤] John Doe   │ Rs. 5K  │ Card   │ ✅ Deliv. │ Dec 01│
│          │ john@mail.com   │         │        │           │      │
│ #100002  │ [👤] Jane Smith │ Rs. 12K │ Cash   │ 📦 Shipped│ Dec 02│
│          │ jane@mail.com   │         │        │           │      │
│ #100003  │ [👤] Bob Wilson │ Rs. 28K │ Card   │ ⏳ Pending │ Dec 03│
│          │ bob@mail.com    │         │        │           │      │
└─────────────────────────────────────────────────────────────────┘

Showing 3 of 3 orders        [Previous] [1] [Next]
```

### Sidebar Dropdown Menu Actions:
```
┌─────────────────────────────────┐
│ [👁️ View] [🖨️ Print] [≡ More]   │
│                    ├─ Processing
│                    ├─ Shipped
│                    ├─ Delivered
│                    ├─ ─ ─ ─ ─ ─
│                    └─ 🗑️ Delete
```

### Status Badge Colors:
```
⏳ Pending      → 🟨 Yellow
🔄 Processing  → 🔵 Blue
📦 Shipped     → 🟦 Primary
✅ Delivered   → 🟩 Green
❌ Cancelled   → 🟥 Red
```

---

## Order Details Page Layout

```
┌─────────────────────────────────────────────────────────────────┐
│ < Orders > #100001                     [🖨️ Print] [📄 Invoice]   │
│ Order details and tracking information [✈️ Shipping Label]      │
└─────────────────────────────────────────────────────────────────┘

┌──────────────────────────────┐ ┌─────────────────────────────────┐
│  📍 Order Status             │ │  👤 Customer Information        │
│                              │ │  Name: John Doe                 │
│ ⏳ → 🔄 → 📦 → ✅             │ │  Email: john@mail.com           │
│ Pending Processing Shipped   │ │  Phone: 0300-XXXXXXX            │
│          Delivered           │ │                                 │
│                              │ │  [View Customer Profile]        │
│ Status: [Processing ▼] [Upd]│ │                                 │
└──────────────────────────────┘ ├─────────────────────────────────┤
                                  │  📍 Shipping Address            │
│  📦 Order Items                 │  123 Main Street                │
│  Product │ Qty │ Price │ Total │  Karachi, KPK 75000             │
├──────────────────────────────┤  │  Pakistan                       │
│ Laptop   │ 1   │ 50K   │ 50K   │                                 │
│ Mouse    │ 2   │ 2K    │ 4K    │  ├─────────────────────────────┤
│ Keyboard │ 1   │ 1K    │ 1K    │  │  💳 Payment Information     │
└──────────────────────────────┘  │  Method: 💳 Credit Card        │
│ Subtotal............ Rs. 45K  │  Amount: Rs. 55,000             │
│ Shipping............ Rs. 2.5K │  Date: Dec 03, 2024             │
│ Tax................ Rs. 2.5K  │                                 │
├──────────────────────────────┤  ├─────────────────────────────┤
│ Total........... Rs. 55,000   │  │  ⚡ Quick Actions         │
└──────────────────────────────┘  │  [🔔 Notify Customer]        │
                                  │  [📄 Download Invoice]       │
│  📝 Order Notes                 │  [✉️ Contact Customer]       │
│  ┌────────────────────────────┐ │  [✖️ Cancel Order]          │
│  │ Add internal notes here... │ │  └─────────────────────────┘
│  │                            │ │
│  │                            │ │
│  └────────────────────────────┘ │
│  [Save Notes]                  │
└────────────────────────────────┘
```

---

## Responsive Design Behavior

### DESKTOP (1200px+)
```
┌────────────────────────────────────┐
│  MAIN CONTENT (8 cols)             │  SIDEBAR (4 cols)
│                                    │
│  [Statistics Cards x4]             │  [Customer Info]
│  [Filters]                         │  [Shipping Address]
│  [Orders Table]                    │  [Payment Info]
│  [Pagination]                      │  [Quick Actions]
│                                    │
└────────────────────────────────────┘
```

### TABLET (768px - 991px)
```
┌─────────────────────────────────────┐
│  MAIN CONTENT (6-8 cols)            │
│                                     │
│  [Statistics Cards x2 per row]      │
│  [Filters - Full width]             │
│  [Orders Table - Scrollable]        │
│                                     │
│  SIDEBAR BELOW MAIN (6-8 cols)      │
│  [Customer] [Shipping] [Payment]    │
│  [Quick Actions - Full width]       │
│                                     │
└─────────────────────────────────────┘
```

### MOBILE (< 768px)
```
┌──────────────────────┐
│                      │
│  [Statistics x1]     │
│  [Statistics x1]     │
│  [Statistics x1]     │
│  [Statistics x1]     │
│  [Filters - Stacked] │
│  [Orders Table -     │
│   Horizontal Scroll] │
│  [Customer Info]     │
│  [Shipping Address]  │
│  [Payment Info]      │
│  [Quick Actions]     │
│                      │
└──────────────────────┘
```

---

## Color Palette Reference

```
PRIMARY COLORS:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🔵 Primary Blue    (#0d6efd)  - Links, main buttons, primary badges
🟢 Success Green   (#198754)  - Revenue, delivered status, positive
🟡 Warning Yellow  (#ffc107)  - Pending status, caution
🔵 Info Cyan       (#17a2b8)  - Processing status, information
🔴 Danger Red      (#dc3545)  - Delete, cancelled, errors

NEUTRAL COLORS:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
⚫ Dark            (#212529)  - Text, headings
⚪ Light           (#f8f9fa)  - Backgrounds, hover states
🩶 Muted Grey      (#6c757d)  - Secondary text, labels
⬜ White           (#ffffff)  - Cards, main background

SPECIAL USAGE:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🔲 Card Background (#ffffff)
🔲 Page Background (#f8f9fa)
🔲 Border Color    (#dee2e6)
🔲 Shadow          rgba(0,0,0,0.1)
```

---

## Typography Scale

```
Page Title........... h1 (2.5rem) - Bold, dark
Section Headers...... h5 (1.25rem) - Semibold
Card Headers......... p/small (0.875rem) - Muted, caps
Body Text............ p (1rem) - Regular
Secondary Text...... small (0.875rem) - Muted
Badge Text.......... small (0.75rem) - Bold

Font Family: System default (Bootstrap default)
Line Height: 1.5 (readable spacing)
Letter Spacing: Normal
```

---

## Component Sizes

```
BUTTONS:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Small Button  ... 32px height
Normal Button ... 36px height
Large Button  ... 40px height

BADGES & ICONS:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Avatar Circle .... 40px diameter
Rounded Badge .... 30px diameter
Icon Size ....... 18-24px
Font Awesome .... v6+

SPACING:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
xs spacing ...... 4px
sm spacing ...... 8px
md spacing ...... 16px
lg spacing ...... 24px
xl spacing ...... 32px
```

---

## Interactive States

```
BUTTON STATES:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Default    → Solid color, pointer cursor
Hover      → Darker shade, slight raise
Active     → Pressed appearance
Disabled   → Grayed out, no-cursor

TABLE ROW STATES:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Default    → White background
Hover      → Light gray background (#f8f9fa)
Selected   → Highlight with border

FORM STATES:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Default    → Standard input
Focus      → Blue border, shadow
Error      → Red border
Success    → Green checkmark
Disabled   → Grayed background
```

---

## Print Layout

When printing (Ctrl+P / Cmd+P), the page:
```
✅ Shows: Main content, tables, important info
❌ Hides: Navigation buttons, action dropdowns, sidebars
✅ Adjusts: Font sizes for readability
✅ Removes: Hover effects, animations
✅ Optimizes: Colors for black & white printing
✅ Formats: Page breaks appropriately
```

---

## Accessibility Features

```
🎨 COLOR CONTRAST:
   Text/Background ratio ≥ 4.5:1 (WCAG AA compliant)

⌨️ KEYBOARD NAVIGATION:
   Tab: Navigate through interactive elements
   Enter: Activate buttons/links
   Space: Toggle checkboxes
   Shift+Tab: Navigate backwards

🔊 SCREEN READER SUPPORT:
   aria-label: Button descriptions
   role: Semantic roles for custom elements
   aria-expanded: Dropdown states
   aria-current: Active navigation items

📱 TOUCH FRIENDLY:
   Button minimum: 44x44px (mobile)
   Clickable area: Properly spaced
   No hover-dependent info
   Swipe gestures supported
```

---

## Animation & Transitions

```
HOVER EFFECTS:
   Background: 200ms ease-in-out
   Border: 200ms ease-in-out
   Color: 200ms ease-in-out
   Transform: 150ms ease-out (subtle raise)

TRANSITIONS:
   Modal open/close: 300ms
   Dropdown expand: 200ms
   Fade in/out: 200ms
   
NO ANIMATION ON:
   Motion-sensitive elements
   Print version
   Accessibility mode enabled
```

---

## Mobile Navigation Pattern

```
DESKTOP:                    MOBILE:
┌─────────────────────┐    ┌─────────────────┐
│ [Menu] Title [Btn]  │    │ [☰] Title [Btn] │
├─────────────────────┤    ├─────────────────┤
│ Nav Items           │    │ Nav Items       │
│ (horizontal)        │    │ (collapsible)   │
└─────────────────────┘    └─────────────────┘
```

---

## Filter UI Pattern

```
┌─────────────────────────────────────────────┐
│ 🔍 [Search input]  [Filter icon]           │
├─────────────────────────────────────────────┤
│ Status: [Dropdown ▼]  Date: [Picker]      │
│ Sort: [Dropdown ▼]    [Apply] [Reset]     │
└─────────────────────────────────────────────┘
```

---

## Status Timeline Pattern

```
Active/Completed:        Current:              Pending:
  ✅ Green               🔄 Animated           ⚪ Gray
  🟢 Filled Circle       ⭕ Spinning           ⬜ Empty Circle
  ━━━ Solid Line         ━━━ Solid Line        - - - Dashed Line
```

---

## Data Table Pattern

```
┌─────────────────────────────────────────┐
│ Header 1 │ Header 2 │ Header 3 │ Action│
├─────────────────────────────────────────┤
│ Data     │ Data     │ Data     │ [Btns]│
│ (light bg on hover)                    │
├─────────────────────────────────────────┤
│ Data     │ Data     │ Data     │ [Btns]│
│ (light bg on hover)                    │
└─────────────────────────────────────────┘
Pagination: [Prev] [1] [Next]
```

---

## Card Component Pattern

```
┌────────────────────────────────┐
│ Header (Light gray background) │
├────────────────────────────────┤
│                                │
│ Content Area (White)           │
│                                │
├────────────────────────────────┤
│ Footer (Optional, light gray)  │
└────────────────────────────────┘

Styles:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Border: None
Shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075)
Padding: 1.5rem
Margin: 1rem bottom
Border Radius: 0.375rem
```

---

**This visual guide helps maintain design consistency across all pages and features.**

*Last Updated: January 10, 2025*
