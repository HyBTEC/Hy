import { NextResponse } from "next/server"

export async function GET() {
  return NextResponse.json({
    status: "ok",
    message: "API is working",
    env: {
      hasApiKey: !!process.env.ANTHROPIC_API_KEY,
    },
  })
}

